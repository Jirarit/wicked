<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReportsController
 *
 * @author Win
 */
class ReportsController extends AppController{
    
    public $uses = array("Product", "ProductMovement");

    
    public function index() {
        
    }
    
    public function weekly_par() {
        if($this->request->is('post')){
            $start = $this->request->data['Report']['from_date'];
            $end = $this->request->data['Report']['to_date'];
            
            $dates = array();
            while( $start <= $end ) {
                $dates[] = $start;
                $start = date('Y-m-d', strtotime($start .' +1 day'));
            }
            $start = $this->request->data['Report']['from_date'];
            
            $tmp = $this->ProductMovement->find('all', array('fields'=>array('product_id', 'SUM(ProductMovement.qty) as qty'), 'conditions'=>array('movement_date <'=>$start), 'group'=>array('product_id')));
            $balance = array();
            foreach($tmp as $data) { $balance[$data['ProductMovement']['product_id']] = $data['0']['qty']; }
            
            $tmp = $this->ProductMovement->find('all', array('fields'=>array('product_id', 'movement_date', 'movement_type', 'SUM(qty) as qty'), 'conditions'=>array('movement_date >='=>$start, 'movement_date <='=>$end), 'group'=>array('product_id', 'movement_date', 'movement_type')));
            $movements = array();
            foreach($tmp as $data) {
                $product_id = $data['ProductMovement']['product_id'];
                $date = substr($data['ProductMovement']['movement_date'], 0, 10);
                $type = $data['ProductMovement']['movement_type'];
                $qty = $data['0']['qty'];
                
                if($type == 'REC'){
                    $type = "I";
                }elseif($type == 'PIC'){
                    $type = "O";
                }elseif($type == 'DES'){
                    $type = "D";
                }else{
                    continue;
                }
                
                if(isset($movements[$product_id][$date][$type])){
                    $movements[$product_id][$date][$type] += $qty;
                }else{
                    $movements[$product_id][$date][$type] = $qty;
                }
            }
            
            
            $fields = array(
                'Product.id','Product.product_no','Product.product_name', 'Product.par_stock', 'Unit.name', 
                'Product.product_category_id','ProductCategory.name'
                );
            $products = $this->Product->find('all', array('fields'=>$fields, 'conditions'=>array('Product.status'=>'A'), 'order'=>array('ProductCategory.sort'=>'asc', 'Product.id')));
            
            $this->set('dates', $dates);
            $this->set('products', $products);
            $this->set('balance', $balance);
            $this->set('movements', $movements);
        }
    }
}
