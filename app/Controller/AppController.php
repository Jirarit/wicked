<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $uses = array('WebAccess');
    public $components = array('Session', 'Cookie');
    
    
    public function beforeFilter() {
        
        if(!$this->Session->check('FirstAccess')){
                $data['WebAccess']['id'] = $this->_VERSION_();
                $data['WebAccess']['remote_by'] = $this->request->isMobile() ? 'M' : 'W';
                $data['WebAccess']['remote_host'] = isset($_SERVER['REMOTE_HOST']) ? @$_SERVER['REMOTE_HOST'] : @$_SERVER['HTTP_USER_AGENT'];
                $data['WebAccess']['remote_addr'] = $_SERVER['REMOTE_ADDR'];
                $data['WebAccess']['remote_port'] = $_SERVER['REMOTE_PORT'];
                $this->WebAccess->save($data);
                $this->Session->write('FirstAccess', true);
        }

        
        if($this->name === "Authentications" && $this->action === "logout"){
            
        }elseif($this->name === "Authentications" && $this->Session->check("User.id") === TRUE){
            $this->redirect(array('controller'=>'Home' , 'action'=>'index'));
        }elseif($this->name === "Authentications" && $this->Cookie->check("User.id") === TRUE){
            $user_info = $this->Cookie->read("User");
            $this->Session->write("User", $user_info);
            $this->redirect(array('controller'=>'Home' , 'action'=>'index'));
        }elseif($this->name !== "Authentications" && $this->Session->check("User.id") === FALSE && $this->Cookie->check("User.id") === FALSE){
            $this->redirect(array('controller'=>'Authentications' , 'action'=>'logout'));
        }elseif($this->name !== "Authentications" && $this->Session->check("User.id") === FALSE && $this->Cookie->check("User.id") === TRUE){
            $user_info = $this->Cookie->read("User");
            $this->Session->write("User", $user_info);
        }
    }
    
    
    public function _VERSION_() {
        $msec = explode(' ',microtime());
        $msec = $msec[0] * 1000000;
        return date("ymdHis") . sprintf("%06d",$msec);
    }
}
