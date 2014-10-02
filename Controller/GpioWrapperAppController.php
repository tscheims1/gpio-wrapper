<?php

App::uses('AppController', 'Controller');

class GpioWrapperAppController extends AppController {
	public function beforeFilter()
	{
		$this->layout = "GpioWrapper.bootstrap";
	}
	
}
