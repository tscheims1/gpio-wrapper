<?php
App::uses('WateringHour', 'GpioWrapper.Model');

/**
 * WateringHour Test Case
 *
 */
class WateringHourTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.gpio_wrapper.watering_hour',
		'plugin.gpio_wrapper.device'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WateringHour = ClassRegistry::init('GpioWrapper.WateringHour');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WateringHour);

		parent::tearDown();
	}

}
