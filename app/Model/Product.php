<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property ProductCategory $ProductCategory
 * @property ProductSubCategory $ProductSubCategory
 * @property Unit $Unit
 */
class Product extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ProductCategory' => array(
			'className' => 'ProductCategory',
			'foreignKey' => 'product_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProductSubCategory' => array(
			'className' => 'ProductSubCategory',
			'foreignKey' => 'product_sub_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Unit' => array(
			'className' => 'Unit',
			'foreignKey' => 'unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function update_current_onhand($product_id) {
            $now = date('Y-m-d H:i:s');
            $query = "UPDATE products "
                    . "SET onhand_qty = (SELECT CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END FROM product_movements WHERE product_id = '{$product_id}') , last_update_onhand = '{$now}'"
                    . "WHERE id = '{$product_id}'";
            $this->query($query);
        }
        
        public function update_all_current_onhand() {
            $now = date('Y-m-d H:i:s');
            $query = "UPDATE products p "
                    . "SET onhand_qty = (SELECT CASE WHEN SUM(qty) IS NULL THEN 0 ELSE SUM(qty) END FROM product_movements WHERE product_id = p.id) , last_update_onhand = '{$now}'";
            $this->query($query);
        }
}
