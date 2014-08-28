<?php
	/*
	 * Plugin specific routes
	 */
	Router::connect('/GpioWrapper/devices/:action',
		array('plugin' => 'GpioWrapper', 'controller' => 'devices'));
	Router::connect('/GpioWrapper/devices/',
		array('plugin' => 'GpioWrapper', 'controller' => 'devices','action' => 'index'));
		
	Router::connect('/GpioWrapper/wateringHours/:action',
		array('plugin' => 'GpioWrapper', 'controller' => 'wateringHours'));
	Router::connect('/GpioWrapper/wateringHours/',
		array('plugin' => 'GpioWrapper', 'controller' => 'wateringHours','action' => 'index'));
?>