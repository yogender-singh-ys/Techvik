<?php

App::uses('AppController', 'Controller');


class PagesController extends AppController {

    public $uses = array('User');


	public function display() {
		
		echo 'display'; die();
	}
	
	public function admin_index(){
		
	  $this->layout = 'admin_login'; 
		
	  if(!empty($this->request->data)){
	  	
	  	if(( $this->request->data['User']['username'] !=  "" )&&(  $this->request->data['User']['password'] !=  "" )){
	  		 
	  		  $userData = $this->User->find('first', array('conditions' => array('User.username' => $this->request->data['User']['username'],'User.password' => $this->request->data['User']['password'],'admin'=>'1')));
	  		  
	  		  if(count($userData)>0){
			  	$this->Session->write("ADMIN_USER",true);
			  	return $this->redirect(array('controller' => 'pages', 'action' => 'dashboard','admin'=>true)); 
			  }else{
			    $this->Flash->set('Username and Password do not match.', array('element' => 'warning'));	
		      } 
	  		
		}else{
			  $this->Flash->set('Username and Password cannot be blank.', array('element' => 'warning'));	
		}
	  }
	
	}

    public function admin_logout(){
    	$this->Session->destroy("ADMIN_USER");
		return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));
	}

    public function admin_dashboard(){
    	if($this->Session->read('ADMIN_USER')){
			$this->layout = "admin_dashboard";
		}else{
		  return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
		}
    }
}

?>
