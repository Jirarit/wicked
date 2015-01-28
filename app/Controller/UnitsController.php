<?php
App::uses('AppController', 'Controller');
/**
 * Units Controller
 *
 * @property Unit $Unit
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UnitsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public $Helpers = array('Display');

        public $uses = array('Unit', 'User');
        public $paginate = array(
            'limit' => 10,
            'order' => array(
                'Unit.name' => 'asc'
            )
        );
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Unit->recursive = 0;
                $this->Paginator->settings = $this->paginate;
                $conditions = array('Unit.status' => 'A');
                
                if($this->request->is('post')){
                    $this->passedArgs['page'] = "1";
                    $this->passedArgs['search'] = $this->request->data['Unit']['search'];
                    
                }else{
                    if ( empty($this->passedArgs['search']) ){
                        $this->passedArgs['search'] = @$this->request->data['Unit']['search'];
                    }
                    if ( empty($this->request->data) ){
                        $this->request->data['Unit']['search'] = $this->passedArgs['search'];
                    }
                }
                
                if(!empty($this->request->data['Unit']['search'])){
                    $this->passedArgs['search'] = $this->request->data['Unit']['search'];
                    $conditions['Unit.name ILIKE'] = '%' . $this->request->data['Unit']['search'] . '%';
                }
                
		$this->set('units', $this->Paginator->paginate('Unit', $conditions));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Unit->exists($id)) {
			throw new NotFoundException(__('Invalid unit'));
		}
		$options = array('conditions' => array('Unit.' . $this->Unit->primaryKey => $id));
                $unit = $this->Unit->find('first', $options);
		$this->set('unit', $unit);
                $user = $this->User->findById($unit['Unit']['create_uid']);
                $this->set('create_uname', $user['User']['full_name']);
                $user = $this->User->findById($unit['Unit']['update_uid']);
                $this->set('update_uname', $user['User']['full_name']);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    $data = $this->request->data;
                    $data['Unit']['create_uid'] = $this->Session->read('User.id');
                    $data['Unit']['update_uid'] = $this->Session->read('User.id');
                    
                    $this->Unit->create();
                    if ($this->Unit->save($data)) {
                            $this->Session->setFlash(__('The unit has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The unit could not be saved. Please, try again.'));
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
		if (!$this->Unit->exists($id)) {
			throw new NotFoundException(__('Invalid unit'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    $data = $this->request->data;
                    $data['Unit']['update_uid'] = $this->Session->read('User.id');

                    if ($this->Unit->save($data)) {
                            $this->Session->setFlash(__('The unit has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The unit could not be saved. Please, try again.'));
                    }
		} else {
			$options = array('conditions' => array('Unit.' . $this->Unit->primaryKey => $id));
			$this->request->data = $this->Unit->find('first', $options);
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
            $this->Unit->id = $id;
            if (!$this->Unit->exists()) {
                    throw new NotFoundException(__('Invalid unit'));
            }

            $data['Unit']['status'] = "I";
            $data['Unit']['update_uid'] = $this->Session->read('User.id');
            if($this->Unit->save($data)){
                $this->Session->setFlash(__('The unit has been deleted.'));
            } else {
                $this->Session->setFlash(__('The unit could not be deleted. Please, try again.'));
            }

            return $this->redirect(array('action' => 'index'));
	}
}
