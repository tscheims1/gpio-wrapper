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
 * 
 */
public function beforeFilter()
{
	parent::beforeFilter();
	$this->loadModel('GpioWrapper.Device');
	
	$repeat = array(
		'none' => __('none'),
		'daily' => __('daily'),
		'weekly' => __('weekly'),
		'monthly' => __('monthly'));
	$selectableDevices = $this->Device->find('list', array(
		'conditions' => array('visibility' => 'visible',),
		'fields' => array('id','name'),
		));
		
	$this->set('selectableDevices',$selectableDevices);
	$this->set('repeat',$repeat);
	
}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		
		
		$this->WateringHour->recursive = 0;
		
		
		$this->set('wateringHours', $this->Paginator->paginate(array('parent_id' => 0)));
		
		$this->loadModel('GpioWrapper.Device');	
		$devices =$this->Device->find('all');
		
		/*
		 * update Device state
		 */
		 App::uses('GpioCommunicator','GpioWrapper.Lib');
		 $gpioCom = new GpioCommunicator();
		 
		 foreach($devices as $key => $device)
		 {
		 		$devices[$key]['Device']['device_state'] = 
		 			$gpioCom->read($device['Device']['bcm_number']) == 0?'enabled':'disabled';
		 } 
		
		$this->set('devices',$devices);
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
				
				$data = $this->request->data;
				$parentId = $this->WateringHour->getLastInsertId();
				$data['WateringHour']['id'] = '';
				/*
				 * add all hidden devices
				 */
				 $devices = $this->Device->find('all',array('conditions' => array(
				 	'visibility' => 'hidden')));
				
				foreach($devices as $device)
				{
					$data['WateringHour']['device_id'] = $device['Device']['id'];
					$data['WateringHour']['parent_id'] = $parentId;
					$this->WateringHour->save($data);
				} 
				
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
				
				$data = $this->request->data;
				$parentId = $data['WateringHour']['id'];
				unset($data['WateringHour']['device_id']);
				
				/*
				 * find all child entries
				 */
				 $whs = $this->WateringHour->find('all',array('conditions' => array(
				 	'parent_id' => $parentId)));
				
				/*
				 * update the child entries
				 */ 
				foreach($whs as $wh)
				{
					$data['WateringHour']['id'] = $wh['WateringHour']['id'];
					
					$this->WateringHour->save($data);
				} 
				
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
		
		/*
		 * TODO: All devices must stop, when a scheduler is deleted...
		 */
		if ($this->WateringHour->delete()) {
			
			$this->WateringHour->deleteAll(array('parent_id' => $id));
			$this->Session->setFlash(__('The watering hour has been deleted.'));
		} else {
			$this->Session->setFlash(__('The watering hour could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
