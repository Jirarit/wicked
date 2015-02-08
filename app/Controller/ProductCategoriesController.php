<?php
App::uses('AppController', 'Controller');
/**
 * ProductCategories Controller
 *
 * @property ProductCategory $ProductCategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductCategoriesController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Display');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

        
        public $uses = array('ProductCategory', 'User');
        public $paginate = array(
            'limit' => 20,
            'order' => array(
                'ProductCategory.sort' => 'asc'
            )
        );
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ProductCategory->recursive = 0;
                $this->Paginator->settings = $this->paginate;
                $conditions = array('ProductCategory.status' => 'A');
                
                if($this->request->is('post')){
                    $this->passedArgs['page'] = "1";
                    $this->passedArgs['search'] = $this->request->data['ProductCategory']['search'];
                    
                }else{
                    if ( empty($this->passedArgs['search']) ){
                        $this->passedArgs['search'] = @$this->request->data['ProductCategory']['search'];
                    }
                    if ( empty($this->request->data) ){
                        $this->request->data['ProductCategory']['search'] = $this->passedArgs['search'];
                    }
                }
                
                if(!empty($this->request->data['ProductCategory']['search'])){
                    $this->passedArgs['search'] = $this->request->data['ProductCategory']['search'];
                    $conditions['ProductCategory.name ILIKE'] = '%' . $this->request->data['ProductCategory']['search'] . '%';
                }
                
		$this->set('productCategories', $this->Paginator->paginate('ProductCategory', $conditions));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
            if (!$this->ProductCategory->exists($id)) {
                    throw new NotFoundException(__('Invalid product category'));
            }
            $options = array('conditions' => array('ProductCategory.' . $this->ProductCategory->primaryKey => $id));
            $productCateogry = $this->ProductCategory->find('first', $options);
            $this->set('productCategory', $productCateogry);
            $user = $this->User->findById($productCateogry['ProductCategory']['create_uid']);
            $this->set('create_uname', $user['User']['full_name']);
            $user = $this->User->findById($productCateogry['ProductCategory']['update_uid']);
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
                    $data['ProductCategory']['create_uid'] = $this->Session->read('User.id');
                    $data['ProductCategory']['update_uid'] = $this->Session->read('User.id');
                    
                    $this->ProductCategory->create();
                    if ($this->ProductCategory->save($data)) {
                            $this->Session->setFlash(__('The product category has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The product category could not be saved. Please, try again.'));
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
		if (!$this->ProductCategory->exists($id)) {
			throw new NotFoundException(__('Invalid product category'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    $data = $this->request->data;
                    $data['ProductCategory']['update_uid'] = $this->Session->read('User.id');

                    if ($this->ProductCategory->save($data)) {
                            $this->Session->setFlash(__('The product category has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The product category could not be saved. Please, try again.'));
                    }
		} else {
			$options = array('conditions' => array('ProductCategory.' . $this->ProductCategory->primaryKey => $id));
			$this->request->data = $this->ProductCategory->find('first', $options);
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
            $this->ProductCategory->id = $id;
            if (!$this->ProductCategory->exists()) {
                    throw new NotFoundException(__('Invalid category'));
            }

            $data['ProductCategory']['status'] = "I";
            $data['ProductCategory']['update_uid'] = $this->Session->read('User.id');
            if($this->ProductCategory->save($data)){
                $this->Session->setFlash(__('The category has been deleted.'));
            } else {
                $this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
            }

            return $this->redirect(array('action' => 'index'));
	}
        
        public function view_sub_category($sub_category_id, $category_id) {
            if (!$this->ProductSubCategory->exists($sub_category_id)) {
                throw new NotFoundException(__('Invalid product category'));
            }
            
            $productSubCateogry = $this->ProductSubCategory->findById($sub_category_id);
            $this->set('productSubCategory', $productSubCateogry);
            $info = $this->User->findById($productSubCateogry['ProductSubCategory']['create_uid']);
            $this->set('create_uname', $info['User']['full_name']);
            $info = $this->User->findById($productSubCateogry['ProductSubCategory']['update_uid']);
            $this->set('update_uname', $info['User']['full_name']);
            $info = $this->ProductCategory->findById($category_id);
            $this->set('product_category', $info['ProductCategory']['name']);
        }
        
        public function add_sub_category($category_id = null){
            if ($this->request->is('post')) {
                $data = $this->request->data;
                $data['ProductSubCategory']['create_uid'] = $this->Session->read('User.id');
                $data['ProductSubCategory']['update_uid'] = $this->Session->read('User.id');

                $this->ProductSubCategory->create();
                if ($this->ProductSubCategory->save($data)) {
                        $this->Session->setFlash(__('The product sub category has been saved.'));
                        return $this->redirect(array('action' => 'view', $category_id));
                } else {
                        $this->Session->setFlash(__('The product sub category could not be saved. Please, try again.'));
                }
            }
        }
        
        public function edit_sub_category($sub_category_id, $category_id){
            if (!$this->ProductSubCategory->exists($sub_category_id)) {
                    throw new NotFoundException(__('Invalid product sub category'));
            }
            if ($this->request->is(array('post', 'put'))) {
                $data = $this->request->data;
                $data['ProductSubCategory']['update_uid'] = $this->Session->read('User.id');

                if ($this->ProductSubCategory->save($data)) {
                        $this->Session->setFlash(__('The product sub category has been saved.'));
                        return $this->redirect(array('action' => 'view', $category_id));
                } else {
                        $this->Session->setFlash(__('The product sub category could not be saved. Please, try again.'));
                }
            } else {
                $options = array('conditions' => array('ProductSubCategory.' . $this->ProductSubCategory->primaryKey => $sub_category_id));
                $this->request->data = $this->ProductSubCategory->find('first', $options);
                $info = $this->ProductCategory->findById($category_id);
                $this->set('product_category', $info['ProductCategory']['name']);
            }
        }
        
        public function delete_sub_category($sub_category_id, $category_id) {
            $this->ProductSubCategory->id = $sub_category_id;
            if (!$this->ProductSubCategory->exists()) {
                    throw new NotFoundException(__('Invalid sub category'));
            }

            $data['ProductSubCategory']['status'] = "I";
            $data['ProductSubCategory']['update_uid'] = $this->Session->read('User.id');
            if($this->ProductSubCategory->save($data)){
                $this->Session->setFlash(__('The sub category has been deleted.'));
            } else {
                $this->Session->setFlash(__('The sub category could not be deleted. Please, try again.'));
            }

            return $this->redirect(array('action' => 'view' , $category_id));
        }
}
