<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public $Helpers = array('Display');


        public $uses = array('User');
        public $paginate = array(
            'limit' => 10,
            'order' => array(
                'User.full_name' => 'asc'
            )
        );
        /**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
                $this->Paginator->settings = $this->paginate;
                $conditions = array('User.status' => 'A');
                
                if($this->request->is('post')){
                    $this->passedArgs['page'] = "1";
                    $this->passedArgs['search'] = $this->request->data['User']['search'];
                    
                }else{
                    if ( empty($this->passedArgs['search']) ){
                        $this->passedArgs['search'] = @$this->request->data['User']['search'];
                    }
                    if ( empty($this->request->data) ){
                        $this->request->data['User']['search'] = $this->passedArgs['search'];
                    }
                }
                
                if(!empty($this->request->data['User']['search'])){
                    $this->passedArgs['search'] = $this->request->data['User']['search'];
                    $conditions['User.full_name ILIKE'] = '%' . $this->request->data['User']['search'] . '%';
                }
                
		$this->set('users', $this->Paginator->paginate('User', $conditions));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                        $data = $this->request->data;
                        $data['User']['create_uid'] = $this->Session->read('User.id');
                        $data['User']['update_uid'] = $this->Session->read('User.id');
                        $data['User']['password'] = md5(md5($data['User']['password']));
                        unset($data['User']['pic']);
                    
                        
			$this->User->create();
			if ($this->User->save($data)) {
                            
                            $data['User']['pic'] = $this->User->id . ".png";
                            if($this->request->data['User']['pic']['size'] > 0 && $this->request->data['User']['pic']['error'] === 0)
                            {
                                $old_dir = $this->request->data['User']['pic']['tmp_name'];
                                $new_dir = WWW_ROOT . "img/user/" . $data['User']['pic'];
                                rename($old_dir, $new_dir);
                                chmod($new_dir, 0777);
                            }
                            
                            
                            $this->Session->setFlash(__('The user has been saved.'));
                            return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {                        
                        $data = $this->request->data;
                        $data['User']['update_uid'] = $this->Session->read('User.id');
                        $data['User']['pic'] = $data['User']['id'] . ".png";
                        
                        if($this->request->data['User']['pic']['size'] > 0 && $this->request->data['User']['pic']['error'] === 0)
                        {
                            $old_dir = $this->request->data['User']['pic']['tmp_name'];
                            $new_dir = WWW_ROOT . "img/user/" . $data['User']['pic'];
                            rename($old_dir, $new_dir);
                            chmod($new_dir, 0777);
                        }
                        
			if ($this->User->save($data)) {
                            if($data['User']['id'] == $this->Session->read('User.id')){
                                unset($data['User']['update_uid']);
                                $this->Session->write($data);
                            }
                            $this->Session->setFlash(__('The user has been saved.'));
                            return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
                
                $data['User']['status'] = "I";
                $data['User']['update_uid'] = $this->Session->read('User.id');
                if($this->User->save($data)){
                    $this->Session->setFlash(__('The user has been deleted.'));
		} else {
                    $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
                
		return $this->redirect(array('action' => 'index'));
	}
        
        public function reset_password($user_id){
            $user = $this->User->findById($user_id);
            $Email = new CakeEmail();
            $Email->from(array('system@wicked.com' => 'Wicked System'));
            $Email->to($user['User']['email']);
            $Email->subject('Reset password');
            $Email->send('My message');
            $this->redirect(array('action' => 'view' , $user_id));
        }
        
        public function edit_own_profile() {
            
        }
}
