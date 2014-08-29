<?php

/**
 * This Class Communicate with the GPIO
 * @author James Mayr
 * @version 1.0
 */ 
class GpioCommunicator
{
	
	public function __construct()
	{
			
	}
	/**
	 * Write a value on a specifc GPIO-Port
	 * @param int $deviceNumber
	 * @param boolean $value
	 */
	public function write($deviceNumber,$value)
	{
		$this->validateDeviceNumber($deviceNumber);
		$this->validateValue($value);
		
		
		exec("gpio -g write ".$deviceNumber." ".$value);
	}
	/**
	 * read from a specific GPIO-Port
	 * @param int $deviceNumber
	 * @return boolean
	 */
	public function read($deviceNumber)
	{
		$this->validateDeviceNumber($deviceNumber);
		
		$value = exec("gpio -g read ".$deviceNumber);
		return $value;
	}
	/**
	 * Validate the deviceNumber
	 * @param int deviceNumber
	 * @throws Exeption
	 */
	private function validateDeviceNumber($deviceNumber)
	{
		if(!is_numeric($deviceNumber) || $deviceNumber < 0 || $deviceNumber > 26)
		{
			throw new Exception("invalid parameter: deviceNumber");
		}	
	}
	/**
	 * validate the given value
	 * @param boolean value
	 * @throws Exception
	 */
	private function validateValue($value)
	{
		if(!($value!= 1 || $value != 0))
			throw new Exception("invalid parameter: value");
	}
}