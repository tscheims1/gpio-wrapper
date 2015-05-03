<?php
/**
 * WateringHourFixture
 *
 */
class WateringHourFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'start' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'duration' => array('type' => 'time', 'null' => false, 'default' => null),
		'device_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'start' => '2014-08-28 16:44:43',
			'duration' => '16:44:43',
			'device_id' => 1
		),
	);

}
