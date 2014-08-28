<?php
App::uses('Device', 'GpioWrapper.Model');

/**
 * Device Test Case
 *
 */
class DeviceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.gpio_wrapper.device',
		'plugin.gpio_wrapper.watering_hour'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Device = ClassRegistry::init('GpioWrapper.Device');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Device);

		parent::tearDown();
	}

}
