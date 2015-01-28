<?php
/**
 * Description of PickUpsController
 *
 * @author Win
 */
class PickUpsController extends AppController{
    
    public $components = array('Paginator', 'Session');
    
    public $uses = array('Product', 'ProductCategory', 'ProductSubCategory', 'Unit', 'User', 'ProductMovement');
    
    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Product.product_name' => 'asc'
        )
    );
    
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
        
        $movement = $this->ProductMovement->find('all', array('fields'=>array('product_id', 'SUM(ProductMovement.qty) as qty'), 'conditions'=>array('movement_type'=>'PIC'), 'group'=>array('product_id')));
        $picked = array();
        foreach ($movement as $value) {
            $picked[$value['ProductMovement']['product_id']] = $value['0']['qty'];
        }
        $this->set('picked', $picked);


        $this->set('products', $this->Paginator->paginate('Product' , $conditions));
        $this->set('productCategories' , $this->ProductCategory->find('list', array('conditions' => array('status' => 'A'), 'order' => array('ProductCategory.name'))));
        $this->set('productSubCategories' , $this->ProductSubCategory->findList());
        $this->set('productUnits' , $this->Unit->find('list', array('conditions' => array('status' => 'A'))));
    }
    
    public function pick($product_id, $pick_qty) {
        $this->ProductMovement->add("PIC" , $product_id , $pick_qty , date('Y-m-d H:i:s'));
        return $this->redirect(array('action' => 'index'));
    }
}
