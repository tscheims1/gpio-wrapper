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
				'state' => 'enabled',
				'start <= ?' => $now->format('Y-m-d'),
				'`time` <= ?' => $now->format('h:i'))));	
				
		foreach($wateringHours as $wateringHour)
		{
			/*
			 * set correct device state
			 */
			$this->Device->save(array(
						'id' => $wateringHour['Device']['id'],
						'device_state' => 
							$this->gpioCom->read($wateringHour['Device']['bcm_number']) == 1? 'enabled':'disabled' ));
			
			
			/*
			 * merge date + time to datetime
			 */ 
			$wateringTime = new DateTime($wateringHour['WateringHour']['start']
				." ".$wateringHour['WateringHour']['time']);
	
			/*
			 * check for repeated hours (if necessary)
			 */
			 if(array_key_exists($wateringHour['WateringHour']['repeat']))
			 {
			 	$wateringTime = $this->repeat($wateringTime, $this->intervalMap[$wateringHour['WateringHour']['repeat']]);
			 }
	
			$invervalString = "PT".abs($wateringHour['WateringHour']['duration'])."M";
			$wateringTime->add(new DateInterval($invervalString));
			
			
			
			if($wateringTime->getTimestamp() >= $now->getTimestamp())
			{
				if($wateringHour['Device']['device_state'] == 'disabled')
				{
					$this->out('start watering'.$wateringHour['WateringHour']['id']);
					
					$gpioCom->write($wateringHour['Device']['bcm_number'],1);
	
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
					$gpioCom->write($wateringHour['Device']['bcm_number'],0); 
					
				}	
			}
			/*
			 * update the  device state
			 */
			$this->Device->save(array(
						'id' => $wateringHour['Device']['id'],
						'device_state' => 
							$this->gpioCom->read($wateringHour['Device']['bcm_number']) == 1? 'enabled':'disabled' ));
			
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