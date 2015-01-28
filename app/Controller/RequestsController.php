<?php
App::uses('AppController', 'Controller');
/**
 * Requests Controller
 *
 */
class RequestsController extends AppController {

	public $components = array('Paginator', 'Session');
        
        public $helpers = array('Display');
        
        public $uses = array('Request', 'RequestDetail', 'Product', 'User', 'ProductMovement');

        public $paginate = array(
            'limit' => 10,
            'order' => array(
                'Request.request_date' => 'DESC'
            )
        );

        public function index(){
            $this->Request->recursive = 0;
            $this->Paginator->settings = $this->paginate;
            $conditions = array('Request.status' => 'N');
            
            if($this->request->is('post')){
                $this->passedArgs = $this->request->data['Request'];
                $this->passedArgs['page'] = "1";
            }else{
                if ( empty($this->passedArgs) && !empty($this->request->data['Request'])){
                    $this->passedArgs = $this->request->data['Request'];
                }
                if ( empty($this->request->data) && !empty($this->passedArgs)){
                    $this->request->data['Request'] = $this->passedArgs;
                }
            }
            
            if(!empty($this->request->data['Request']['status'])){
                $this->passedArgs['status'] = $this->request->data['Request']['status'];
                $conditions['Request.status'] = $this->request->data['Request']['status'];
            }
            if(!empty($this->request->data['Request']['from_date'])){
                $this->passedArgs['from_date'] = $this->request->data['Request']['from_date'];
                $conditions['date(Request.request_date) >='] = $this->request->data['Request']['from_date'];
            }
            if(!empty($this->request->data['Request']['to_date'])){
                $this->passedArgs['to_date'] = $this->request->data['Request']['to_date'];
                $conditions['date(Request.request_date) <='] = $this->request->data['Request']['to_date'];
            }
            
            $this->set('requests', $this->Paginator->paginate('Request', $conditions));
        }

        public function view($request_id) {
            $this->Request->id = $request_id;
            if (!$this->Request->exists()) {
                    throw new NotFoundException(__('Invalid request'));
            }
            
            $request = $this->Request->findById($request_id);
            $request_details = $this->RequestDetail->findAllByRequestId($request_id);
            
            $product_condition = array();
            foreach ($request_details as $value) {
                $product_condition[] = $value['RequestDetail']['product_id'];
            }
            $this->Product->recursive = -1;
            $products = $this->Product->find('all', array('conditions' => array('id'=>$product_condition)));
            $product_info = array();
            foreach($products as $value){
                $product_id = $value['Product']['id'];
                $product_info[$product_id]['product_no'] = $value['Product']['product_no'];
                $product_info[$product_id]['product_name'] = $value['Product']['product_name'];
            }
            $this->set('product_info', $product_info);
            
            $user_condition = array($request['Request']['create_uid'], $request['Request']['update_uid'], $request['Request']['receive_uid']);
            $user = $this->User->find('all', array('conditions'=>array('id'=>$user_condition)));
            
            foreach ($user as $value) {
                if($value['User']['id'] == $request['Request']['create_uid']){
                    $this->set('create_by', $value['User']['full_name']);
                }
                if($value['User']['id'] == $request['Request']['update_uid']){
                    $this->set('update_by', $value['User']['full_name']);
                }
                if($value['User']['id'] == $request['Request']['receive_uid']){
                    $this->set('receive_by', $value['User']['full_name']);
                }
            }
            
            $this->set('request', $request);
            $this->set('request_details', $request_details);
        }
        
        public function add($msg = '') {
            if($this->request->is('post')){
                
                $this->Request->begin();
                
                $data = array();
                $data['Request']['request_date'] = date('Y-m-d');
                $data['Request']['create_uid'] = @$_SESSION['User']['id'];
                $data['Request']['update_uid'] = @$_SESSION['User']['id'];
                $this->Request->create();
                $this->Request->save($data);
                $request_id = $this->Request->id;
                $count_child = 0;
                foreach($this->request->data['Request'] as $product_id => $order_qty){
                    if(!empty($order_qty) && !empty($product_id)){
                        $data = array();
                        $data['RequestDetail']['request_id'] = $request_id;
                        $data['RequestDetail']['product_id'] = $product_id;
                        $data['RequestDetail']['request_qty'] = abs($order_qty);
                        $data['RequestDetail']['create_uid'] = @$_SESSION['User']['id'];
                        $data['RequestDetail']['update_uid'] = @$_SESSION['User']['id'];
                        $this->RequestDetail->create();
                        $this->RequestDetail->save($data);
                        $count_child++;
                    }
                }
                if($count_child === 0){
                    $this->Request->rollback();
                    return $this->redirect(array('action' => 'add', base64_encode("Cannot create request")));
                }  else {
                    $this->Request->commit();
                    $this->clear_temp();
                }
            }
            
            if(!empty($_SESSION['TEMP_REQUEST'])){
                $product_list = array();
                foreach ($_SESSION['TEMP_REQUEST'] as $product_id => $product_qty) {
                    $product_list[] = $product_id;
                }
                $datas = $this->Product->find('all', array(
                                                        'fields'=>array('Product.id','Product.product_no','Product.product_name','Product.par_stock','onhand_qty'), 
                                                        'conditions'=>array('Product.id'=>$product_list)
                                                    ));
                
                foreach($datas as $value){
                    $product_id = $value['Product']['id'];
                    $products[$product_id]['product_no'] = $value['Product']['product_no'];
                    $products[$product_id]['product_name'] = $value['Product']['product_name'];
                    $products[$product_id]['par_stock'] = $value['Product']['par_stock'];
                    $products[$product_id]['onhand_qty'] = $value['Product']['onhand_qty'];
                }
                $this->set('products', $products);
            }
            $this->set('msg', base64_decode($msg));
        }
        
        public function remove_temp_item($product_id) {
            unset($_SESSION['TEMP_REQUEST'][$product_id]);
            return $this->redirect(array('action' => 'add'));
        }
        
        public function clear_temp(){
            unset($_SESSION['TEMP_REQUEST']);
            return $this->redirect(array('action' => 'index'));
        }

        public function full_fill_stock() {
            $this->Product->update_all_current_onhand();
            
            $products = $this->Product->find('all', array('conditions'=>array('onhand_qty < par_stock')));
            if(empty($products)){
                return $this->redirect(array('action' => 'add', base64_encode("Not found item to full fill stock")));
            }
            
            foreach($products as $data){
                $product_id = $data['Product']['id'];
                $order_qty = $data['Product']['par_stock'] - $data['Product']['onhand_qty'];
                $_SESSION['TEMP_REQUEST'][$product_id] = $order_qty;
            }
                    
            return $this->redirect(array('action' => 'add'));
        }

        public function delete($id = null) {
            $this->Request->id = $id;
            if (!$this->Request->exists()) {
                    throw new NotFoundException(__('Invalid request'));
            }
            $this->Request->begin();
            $this->Request->delete($id);
            $this->RequestDetail->deleteAll(array('RequestDetail.request_id' => $id));
            $this->Request->commit();
            return $this->redirect(array('action' => 'index'));
        }
        
        public function receive($request_id) {
            $this->Request->id = $request_id;
            if (!$this->Request->exists()) {
                    throw new NotFoundException(__('Invalid request'));
            }
            
            if($this->request->is('post')){
                $this->Request->begin();
                
                $receive_date = date('Y-m-d H:i:s');
                
                foreach($this->request->data['Request'] as $request_detail_id => $value){
                    $receive_qty = $value['receive_qty'];
                    $product_id = $value['product_id'];
                    
                    $data = array();
                    $this->RequestDetail->id = $request_detail_id;
                    $data['RequestDetail']['receive_qty'] = $receive_qty;
                    $data['RequestDetail']['update_uid'] = @$_SESSION['User']['id'];
                    $this->RequestDetail->save($data);
                    
                    $this->ProductMovement->add("REC" , $product_id , $receive_qty , $receive_date , $request_id);
                    $this->Product->update_current_onhand($product_id);
                }
                $data = array();
                $this->Request->id = $request_id;
                $data['Request']['status'] = 'R';
                $data['Request']['receive_date'] = $receive_date;
                $data['Request']['receive_uid'] = @$_SESSION['User']['id'];
                $data['Request']['update_uid'] = @$_SESSION['User']['id'];
                $this->Request->save($data);
                $this->Request->commit();
                return $this->redirect(array('action' => 'index'));
            }
            
            $request = $this->Request->findById($request_id);
            $request_details = $this->RequestDetail->findAllByRequestId($request_id);
            
            $product_condition = array();
            foreach ($request_details as $value) {
                $product_condition[] = $value['RequestDetail']['product_id'];
            }
            $this->Product->recursive = -1;
            $products = $this->Product->find('all', array('conditions' => array('id'=>$product_condition)));
            $product_info = array();
            foreach($products as $value){
                $product_id = $value['Product']['id'];
                $product_info[$product_id]['product_no'] = $value['Product']['product_no'];
                $product_info[$product_id]['product_name'] = $value['Product']['product_name'];
            }
            $this->set('product_info', $product_info);
            
            $user_condition = array($request['Request']['create_uid'], $request['Request']['update_uid'], $request['Request']['receive_uid']);
            $user = $this->User->find('all', array('conditions'=>array('id'=>$user_condition)));
            
            foreach ($user as $value) {
                if($value['User']['id'] == $request['Request']['create_uid']){
                    $this->set('create_by', $value['User']['full_name']);
                }
                if($value['User']['id'] == $request['Request']['update_uid']){
                    $this->set('update_by', $value['User']['full_name']);
                }
                if($value['User']['id'] == $request['Request']['receive_uid']){
                    $this->set('receive_by', $value['User']['full_name']);
                }
            }
            
            $this->set('request', $request);
            $this->set('request_details', $request_details);
	}
        
        public function receive_all($request_id) {
            $request_details = $this->RequestDetail->findAllByRequestId($request_id);
            
            
            $this->Request->begin();
                
            $receive_date = date('Y-m-d H:i:s');

            foreach($request_details as $value){
                $request_detail_id = $value['RequestDetail']['id'];
                $receive_qty = $value['RequestDetail']['request_qty'];
                $product_id = $value['RequestDetail']['product_id'];

                $data = array();
                $this->RequestDetail->id = $request_detail_id;
                $data['RequestDetail']['receive_qty'] = $receive_qty;
                $data['RequestDetail']['update_uid'] = @$_SESSION['User']['id'];
                $this->RequestDetail->save($data);

                $this->ProductMovement->add("REC" , $product_id , $receive_qty , $receive_date , $request_id);
                $this->Product->update_current_onhand($product_id);
            }
            $data = array();
            $this->Request->id = $request_id;
            $data['Request']['status'] = 'R';
            $data['Request']['receive_date'] = $receive_date;
            $data['Request']['receive_uid'] = @$_SESSION['User']['id'];
            $data['Request']['update_uid'] = @$_SESSION['User']['id'];
            $this->Request->save($data);
            $this->Request->commit();
            return $this->redirect(array('action' => 'index'));
	}
}
