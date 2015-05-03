<?php
App::uses('GpioWrapperAppController', 'GpioWrapper.Controller');
/**
 * Devices Controller
 *
 * @property Device $Device
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DevicesController extends GpioWrapperAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Device->recursive = 0;
		$this->set('devices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Device->exists($id)) {
			throw new NotFoundException(__('Invalid device'));
		}
		$options = array('conditions' => array('Device.' . $this->Device->primaryKey => $id));
		$this->set('device', $this->Device->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Device->create();
			if ($this->Device->save($this->request->data)) {
				$this->Session->setFlash(__('The device has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The device could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Device->exists($id)) {
			throw new NotFoundException(__('Invalid device'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Device->save($this->request->data)) {
				$this->Session->setFlash(__('The device has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The device could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Device.' . $this->Device->primaryKey => $id));
			$this->request->data = $this->Device->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Device->id = $id;
		if (!$this->Device->exists()) {
			throw new NotFoundException(__('Invalid device'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Device->delete()) {
			$this->Session->setFlash(__('The device has been deleted.'));
		} else {
			$this->Session->setFlash(__('The device could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function change_state($id =null)
	{
			
		$device = $this->Device->find('first', array('conditions'=> array('Device.id' => $id)));
		
		App::uses('GpioCommunicator','GpioWrapper.Lib');
		
		
		$gpioCom = new GpioCommunicator();
		$state = $gpioCom->read($device['Device']['bcm_number']);
		
		$value = 1;
		if($state == 1)$value = 0;
		
		$gpioCom->write($device['Device']['bcm_number'],$value);
		
	}
	public function enable($id = null)
	{
		$device = $this->Device->find('first', array('conditions'=> array('Device.id' => $id)));
		App::uses('GpioCommunicator','GpioWrapper.Lib');
		$gpioCom = new GpioCommunicator();
		$gpioCom->write($device['Device']['bcm_number'],0);
		$this->redirect(array('controller' => 'watering_hours','action' => 'index'));
	}
	public function disable($id = null)
	{
		$device = $this->Device->find('first', array('conditions'=> array('Device.id' => $id)));
		App::uses('GpioCommunicator','GpioWrapper.Lib');
		$gpioCom = new GpioCommunicator();
		$gpioCom->write($device['Device']['bcm_number'],1);
		$this->redirect(array('controller' => 'watering_hours', 'action' => 'index'));	
	}
	
}
