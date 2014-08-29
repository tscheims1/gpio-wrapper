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
	
	public function main()
	{
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
			 * merge date + time to datetime
			 */ 
			$wateringTime = new DateTime($wateringHour['WateringHour']['start']
				." ".$wateringHour['WateringHour']['time']);
			
			$invervalString = "PT".abs($wateringHour['WateringHour']['duration'])."M";
			$wateringTime->add(new DateInterval($invervalString));
			
			
			if($wateringTime->getTimestamp() >= $now->getTimestamp())
			{
				if($wateringHour['Device']['device_state'] == 'disabled')
				{
					$this->out('start watering'.$wateringHour['WateringHour']['id']);
					
					//TODO: outsource in Communicator
					$this->Device->save(array(
						'id' => $wateringHour['Device']['id'],
						'device_state' => 'enabled'));
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
					 
					//TODO: outsource in Communicator
					$this->Device->save(array(
						'id' => $wateringHour['Device']['id'],
						'device_state' => 'disabled'));
				}	
			}
		}	
	}
	
}
/*
 * NOTE: Start under windows:
 *c:\Program Files (x86)\xampp\htdocs\gpio-wrapper\app>"c:\Program Files (x86)\xampp\php\php.exe" ..\lib\Cake\Console\cake.php GpioWrapper.Gpio
 * 
 */