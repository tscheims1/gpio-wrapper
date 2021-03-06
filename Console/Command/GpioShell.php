<?php
/**
 * This Shell checks for scheduled watering
 * starts and stops the the devices on the gpio
 * @author James Mayr
 * @version 1.0
 */

class GpioShell extends AppShell
{
	public $uses = array('GpioWrapper.Device','GpioWrapper.WateringHour');
	/**
	 * An Instance of the GpioCommunicator
	 * @var object
	 */
	private $gpioCom;
	
	/**
	 * Interval Map
	 * @var array
	 */
	 private $intervalMap = array(
	 	'daily' => 'P1D',
	 	'weekly' => 'P1W',
		'monthly' => 'P1M');
	
	public function main()
	{
		App::uses('GpioCommunicator','GpioWrapper.Lib');
		$this->gpioCom = new GpioCommunicator();
		$now = new DateTime();
		
		/*
		 * get all enabled watering hours from the past
		 */ 
		$wateringHours = $this->WateringHour->find('all',array(
			'conditions' => array(
				'state != ?' => 'disabled',
				'start <= ?' => $now->format('Y-m-d')
				)));	
		
		$childsToStart = array();
		$childsToStop = array();		
		
		foreach($wateringHours as $wateringHour)
		{
			/*
			 * set correct device state
			 */
			
			$this->Device->save(array(
						'id' => $wateringHour['Device']['id'],
						'device_state' => 
							$this->gpioCom->read($wateringHour['Device']['bcm_number']) == 0? 'enabled':'disabled' ));
			
			
			/*
			 * merge date + time to datetime
			 */ 
			$wateringTime = new DateTime($wateringHour['WateringHour']['start']
				." ".$wateringHour['WateringHour']['time']);
			$endWateringHour = clone $wateringTime;
			/*
			 * check for repeated hours (if necessary)
			 */
			 if(array_key_exists($wateringHour['WateringHour']['repeat'],$this->intervalMap))
			 {
			 	$wateringTime = $this->repeat($wateringTime, $this->intervalMap[$wateringHour['WateringHour']['repeat']]);
			 }
			$invervalString = "PT".abs($wateringHour['WateringHour']['duration'])."M";
			$endWateringHour->add(new DateInterval($invervalString));
			
		
			
			if($wateringTime->getTimestamp() <= $now->getTimestamp() && 
				$now->getTimestamp() <= $endWateringHour->getTimestamp())
			{
				
				if($wateringHour['WateringHour']['state'] == 'enabled')
				{
					$this->out('start watering'.$wateringHour['WateringHour']['id']);
					$this->WateringHour->save(array(
						'id' => $wateringHour['WateringHour']['id'],
						'state' => 'working'));
					//starting Watering Hours
					if($wateringHour['WateringHour']['parent_id'] ==0)
					{	
						$this->gpioCom->write($wateringHour['Device']['bcm_number'],0);
					}
					else 
					{
						$childsToStart [$wateringHour['Device']['bcm_number']] = $wateringHour['WateringHour']['id'];
					}

					$this->WateringHour->save(array(
						'id' => $wateringHour['WateringHour']['id'],
						'state' => 'working'));	
					
				}
				else if($wateringHour['WateringHour']['state'] == 'working')
				{
					if($wateringHour['WateringHour']['parent_id'] !=0)
					{
						$childsToStart [$wateringHour['Device']['bcm_number']] = $wateringHour['WateringHour']['id'];
					}	
				}
		
			}
			else
			{
				
				
				if($wateringHour['Device']['device_state'] == 'enabled')
				{
					
					$this->out('stop watering'.$wateringHour['WateringHour']['id']);
					
					/*
					 * stop the watering
					 */ 
					if($wateringHour['WateringHour']['parent_id'] ==0)
					{	
						$this->gpioCom->write($wateringHour['Device']['bcm_number'],1);
					}
					else 
					{
						$childsToStop [$wateringHour['Device']['bcm_number']] = $wateringHour['WateringHour']['id'];
					}
				}
				$this->WateringHour->save(array(
						'id' => $wateringHour['WateringHour']['id'],
						'state' => 'enabled'));	
				

			}
			/*
			 * update the  device state
			 */
			$this->Device->save(array(
						'id' => $wateringHour['Device']['id'],
						'device_state' => 
							$this->gpioCom->read($wateringHour['Device']['bcm_number']) == 0? 'enabled':'disabled' ));
			
			
		}

		/*
		 * update childs
		 */
		foreach($childsToStop as $key => $ele)
		{
			//stop all unused childs
			if(!array_key_exists($key, $childsToStart))
			{
				$this->gpioCom->write($key,1);	
				$this->WateringHour->save(array(
						'id' => $ele,
						'state' => 'enabled'));	
			}	
		}
		
		//Start all used childs
		
		foreach($childsToStart as $key => $ele)
		{
			
			$this->gpioCom->write($key,0);
			$this->WateringHour->save(array(
						'id' => $ele,
						'state' => 'working'));			
		}
			
	}
	/**
	 * check for the last sheduled watering hour
	 * @param DateTime $dateObject
	 * @param string $interval
	 * @return DateTime
	 */ 
	private function repeat($dateObject,$interval)
	{
		$tmp = clone $dateObject;
		$now = new DateTime();
		for(;;)
		{
			if($tmp->getTimestamp() <= $now->getTimestamp())
				$tmp->add(new DateInterval($interval));
			else {
				$tmp->sub(new DateInterval($interval));
				return $tmp;
			}
		}
	}
	
}
/*
 * NOTE: Start under windows:
 *c:\Program Files (x86)\xampp\htdocs\gpio-wrapper\app>"c:\Program Files (x86)\xampp\php\php.exe" ..\lib\Cake\Console\cake.php GpioWrapper.Gpio
 * 
 */