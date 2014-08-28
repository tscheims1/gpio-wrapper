<?php
App::uses('GpioWrapperAppController', 'GpioWrapper.Controller');
/**
 * WateringHours Controller
 *
 * @property WateringHour $WateringHour
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class WateringHoursController extends GpioWrapperAppController {

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
		$this->WateringHour->recursive = 0;
		$this->set('wateringHours', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->WateringHour->exists($id)) {
			throw new NotFoundException(__('Invalid watering hour'));
		}
		$options = array('conditions' => array('WateringHour.' . $this->WateringHour->primaryKey => $id));
		$this->set('wateringHour', $this->WateringHour->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->WateringHour->create();
			if ($this->WateringHour->save($this->request->data)) {
				$this->Session->setFlash(__('The watering hour has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The watering hour could not be saved. Please, try again.'));
			}
		}
		$devices = $this->WateringHour->Device->find('list');
		$this->set(compact('devices'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->WateringHour->exists($id)) {
			throw new NotFoundException(__('Invalid watering hour'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->WateringHour->save($this->request->data)) {
				$this->Session->setFlash(__('The watering hour has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The watering hour could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('WateringHour.' . $this->WateringHour->primaryKey => $id));
			$this->request->data = $this->WateringHour->find('first', $options);
		}
		$devices = $this->WateringHour->Device->find('list');
		$this->set(compact('devices'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->WateringHour->id = $id;
		if (!$this->WateringHour->exists()) {
			throw new NotFoundException(__('Invalid watering hour'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->WateringHour->delete()) {
			$this->Session->setFlash(__('The watering hour has been deleted.'));
		} else {
			$this->Session->setFlash(__('The watering hour could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
