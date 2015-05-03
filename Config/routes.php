<?php
	/*
	 * Plugin specific routes
	 */
	Router::connect('/GpioWrapper/devices/:action',
		array('plugin' => 'GpioWrapper', 'controller' => 'devices'));
	Router::connect('/GpioWrapper/devices/:action/:id',
		array('plugin' => 'GpioWrapper', 'controller' => 'devices'),
		array('pass'=>array('id')));
	Router::connect('/GpioWrapper/devices',
		array('plugin' => 'GpioWrapper', 'controller' => 'devices','action' => 'index'));
		
	Router::connect('/GpioWrapper/watering_hours/:action',
		array('plugin' => 'GpioWrapper', 'controller' => 'wateringHours'));
	Router::connect(
		'/GpioWrapper/watering_hours/:action/:id',
		array('plugin' => 'GpioWrapper', 'controller' => 'wateringHours'),
		array('pass'=>array('id')));
	Router::connect('/GpioWrapper/watering_hours',
		array('plugin' => 'GpioWrapper', 'controller' => 'wateringHours','action' => 'index'));
?>