<?php
App::uses('AppModel', 'Model');
/**
 * ProductSubCategory Model
 *
 */
class ProductSubCategory extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
        
        
        public function findList($product_category_id = NULL) {
            if(!empty($product_category_id)){
                return $this->find('list' , array('conditions'=>array('ProductSubCategory.product_category_id' => $product_category_id, 'ProductSubCategory.status' => 'A')));
            }else{
                $datas = $this->find('all', array('conditions'=>array('ProductSubCategory.status' => 'A'), 'order'=>array('ProductSubCategory.product_category_id','ProductSubCategory.name')));
                $result = array();
                foreach($datas as $data){
                    $id = $data['ProductSubCategory']['id'];
                    $name = $data['ProductSubCategory']['name'];
                    $cate_id = $data['ProductSubCategory']['product_category_id'];
                    $result[$cate_id][$id] = $name;
                }
                
                return $result;
            }
        }

}
