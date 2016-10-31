<?php
App::uses('AppController', 'Controller');

class ArticlesController extends AppController {
	
	public $uses = array('Article');
	public $components = array('Misc');
	
	public function admin_index(){
		if($this->Session->read('ADMIN_USER')){
			$this->layout = "admin_dashboard";
		}else{
		  return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
		}
	}

    public function admin_add($id=""){
        if($this->Session->read('ADMIN_USER')){
			$this->layout = "admin_dashboard";
			
			if(!empty($id)){
				 // redirect to edit page
				 if(!empty($this->request->data)){
				 	  $validatedResponse = $this->Misc->validateData($this->request->data['Article'],array('headline'=>'Headline','subheadline'=>'Sub-Headline','page_title'=>'Webpage title','keywords'=>'keywords','meta_desc'=>'Meta description','content'=>'Content','status'=>'Status'));
					  if(count($validatedResponse)>0)
					  {
					  	$this->Flash->set( ucfirst(implode('<br/>',$validatedResponse)) , array('element' => 'warning'));	
					  }
					  else{
					  	 $this->request->data['Article']['alias'] = $this->Misc->slugify($this->request->data['Article']['headline']);
					  	 $this->Article->create();
					  	 $result = $this->Article->save(($this->request->data));
					  	 $this->Flash->set( "Article edited." , array('element' => 'success'));	
					  	 $article= $this->Article->findById($id);
				 	     $this->request->data = $article;
		 			  }
				 }else{
				 	$article= $this->Article->findById($id);
				 	$this->request->data = $article;
				 }
			}else{
				// redirect to add page 
				if(!empty($this->request->data)){
					  
				 	  $validatedResponse = $this->Misc->validateData($this->request->data['Article'],array('headline'=>'Headline','subheadline'=>'Sub-Headline','page_title'=>'Webpage title','keywords'=>'keywords','meta_desc'=>'Meta description','content'=>'Content','status'=>'Status'));
				 	  
					  if(count($validatedResponse)>0)
					  {
					  	$this->Flash->set( ucfirst(implode('<br/>',$validatedResponse)) , array('element' => 'warning'));	
					  }
					  else{
					  	 $this->request->data['Article']['alias'] = $this->Misc->slugify($this->request->data['Article']['headline']);
					  	 $this->Article->create();
					  	 $result = $this->Article->save(($this->request->data));
					  	 $this->Flash->set( "Article added." , array('element' => 'success'));	
					  	 $article= $this->Article->findById($this->Article->getInsertID());
				 	     $this->request->data = $article;
		 			  }
				 }
			}
			
		}else{
		  return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
		}
	}

    public function admin_delete($id) {}
	
	
}
?>
