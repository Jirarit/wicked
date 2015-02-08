<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

        public $uses = array('Product', 'ProductCategory', 'ProductSubCategory', 'Unit', 'User');


        public $paginate = array(
            'limit' => 10,
            'order' => array(
                'Product.product_name' => 'asc'
            )
        );
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Product->recursive = 0;
                $this->Paginator->settings = $this->paginate;
                $conditions = array('Product.status' => 'A');
                
                if($this->request->is('post')){
                    $this->passedArgs = $this->request->data['Product'];
                }else{
                    if ( empty($this->passedArgs) && !empty($this->request->data['Product'])){
                        $this->passedArgs = $this->request->data['Product'];
                    }
                    if ( empty($this->request->data) && !empty($this->passedArgs)){
                        $this->request->data['Product'] = $this->passedArgs;
                    }
                }
                
                if(!empty($this->request->data['Product']['search'])){
                    $this->passedArgs['search'] = $this->request->data['Product']['search'];
                    $conditions['OR']['Product.product_no ILIKE'] = '%' . $this->request->data['Product']['search'] . '%';
                    $conditions['OR']['Product.product_name ILIKE'] = '%' . $this->request->data['Product']['search'] . '%';
                }
                if(!empty($this->request->data['Product']['product_category_id'])){
                    $this->passedArgs['product_category_id'] = $this->request->data['Product']['product_category_id'];
                    $conditions['Product.product_category_id'] = $this->request->data['Product']['product_category_id'];
                }
                if(!empty($this->request->data['Product']['product_sub_category_id'])){
                    $this->passedArgs['product_sub_category_id'] = $this->request->data['Product']['product_sub_category_id'];
                    $conditions['Product.product_sub_category_id'] = $this->request->data['Product']['product_sub_category_id'];
                    
                }
                
                
		$this->set('products', $this->Paginator->paginate('Product' , $conditions));
                $this->set('productCategories' , $this->ProductCategory->find('list', array('conditions' => array('status' => 'A'), 'order' => array('ProductCategory.sort'))));
                $this->set('productSubCategories' , $this->ProductSubCategory->findList());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
                $product = $this->Product->find('first', $options);
		$this->set('product', $product);
                
                $info = $this->ProductCategory->findById($product['Product']['product_category_id']);
                $this->set('category', $info['ProductCategory']['name']);
                $info = $this->ProductSubCategory->findById($product['Product']['product_sub_category_id']);
                $this->set('sub_category', $info['ProductSubCategory']['name']);
                $info = $this->Unit->findById($product['Product']['unit_id']);
                $this->set('unit', $info['Unit']['name']);
                
                $info = $this->User->findById($product['Product']['create_uid']);
                $this->set('create_uname', @$info['User']['full_name']);
                $info = $this->User->findById($product['Product']['update_uid']);
                $this->set('update_uname', @$info['User']['full_name']);
                
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    $data = $this->request->data;
                    $data['Product']['create_uid'] = $this->Session->read('User.id');
                    $data['Product']['update_uid'] = $this->Session->read('User.id');
                    
                    $this->Product->create();
                    if ($this->Product->save($data)) {
                            $this->Session->setFlash(__('The product has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The product could not be saved. Please, try again.'));
                    }
		}
                $this->set('productCategories' , $this->ProductCategory->find('list', array('conditions' => array('status' => 'A'), 'order' => array('ProductCategory.name'))));
                $this->set('productSubCategories' , $this->ProductSubCategory->findList());
                $this->set('units' , $this->Unit->find('list', array('conditions' => array('status' => 'A'), 'order' => array('Unit.name'))));
                
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
                        $data = $this->request->data;
                        $data['Product']['update_uid'] = $this->Session->read('User.id');
                    
			if ($this->Product->save($data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
                
                $this->set('productCategories' , $this->ProductCategory->find('list', array('conditions' => array('status' => 'A'), 'order' => array('ProductCategory.name'))));
                $this->set('productSubCategories' , $this->ProductSubCategory->findList());
                $this->set('units' , $this->Unit->find('list', array('conditions' => array('status' => 'A'), 'order' => array('Unit.name'))));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            $this->Product->id = $id;
            if (!$this->Product->exists()) {
                    throw new NotFoundException(__('Invalid category'));
            }

            $data['Product']['status'] = "I";
            $data['Product']['update_uid'] = $this->Session->read('User.id');
            if($this->Product->save($data)){
                $this->Session->setFlash(__('The product has been deleted.'));
            } else {
                $this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
            }

            return $this->redirect(array('action' => 'index'));
	}
}
