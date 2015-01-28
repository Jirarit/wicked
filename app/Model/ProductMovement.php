<?php
App::uses('AppModel', 'Model');
/**
 * ProductMovement Model
 *
 */
class ProductMovement extends AppModel {

    public function add($type , $product_id , $qty , $date = NULL , $ref1 = NULL) {
        
        if($type == 'REC'){
            $qty = abs($qty);
        }elseif($type == 'PIC' || $type == 'DES'){
            $qty = abs($qty) * -1;
        }
        
        $data['ProductMovement']['movement_date'] = $date === NULL ? date('Y-m-d') : $date;
        $data['ProductMovement']['movement_type'] = $type;
        $data['ProductMovement']['product_id'] = $product_id;
        $data['ProductMovement']['qty'] = $qty;
        $data['ProductMovement']['ref1'] = $ref1;
        $data['ProductMovement']['create_uid'] = @$_SESSION['User']['id'];
        $data['ProductMovement']['update_uid'] = @$_SESSION['User']['id'];
        $this->create();
        $this->save($data);
    }
}
