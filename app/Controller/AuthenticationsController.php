<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthenticationsController
 *
 * @author Win
 */
class AuthenticationsController extends AppController {
    
    public $uses = array("User");
    
    public function login(){
        $this->layout = "login";
        
        if(!empty($this->data)){
            $login = $this->data['User']['username'];
            $password = md5(md5($this->data['User']['password']));
            $auto_login = $this->data['User']['auto_login'];
            
            $user_info = $this->User->find('first', array('conditions'=>array('login' => $login, 'status'=>'A')));
            if(empty($user_info)){
                $this->set('msg', 'Invalid Username');
            }elseif($password !== $user_info['User']['password']){
                $this->set('msg', 'Password wrong');
            }else{
                unset($user_info['User']['password']);
                unset($user_info['User']['created']);
                unset($user_info['User']['modified']);
                unset($user_info['User']['create_uid']);
                unset($user_info['User']['update_uid']);
                $this->Session->write($user_info);
                if($auto_login === "Y"){
                    $this->Cookie->write('User', $user_info, TRUE, '10 days');
                }
                $this->redirect(array('controller'=>'Home', 'action'=>'index'));
            }
        }
    }

    public function logout(){
        $this->Session->destroy();
        $this->Cookie->destroy();
        $this->redirect(array('action'=>'login'));
    }
}
