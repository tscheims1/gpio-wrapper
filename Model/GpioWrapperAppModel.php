<?php

App::uses('AppModel', 'Model');

class GpioWrapperAppModel extends AppModel {
	public function beforeFilter()
	{
		$this->setLayout('GpioWrapper.default');
	}
}
