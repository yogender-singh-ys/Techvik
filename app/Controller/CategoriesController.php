<?php
App::uses('AppController', 'Controller');

class CategoriesController extends AppController {
	
	public $uses = array('Category');
	public $components = array('Misc');
	
	public function admin_index(){
		if($this->Session->read('ADMIN_USER')){
			$this->layout = "admin_dashboard";
			$categories = $this->Category->find('all',array('conditions'=>array('deleted'=>1,'category_id'=>0)));
			$this->set('categories',$categories);
		}else{
		  return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
		}
	}

    public function admin_add($id=""){
        if($this->Session->read('ADMIN_USER')){
			$this->layout = "admin_dashboard";
			
			$categories = $this->Category->find('list',array('conditions'=>array('deleted'=>1,'category_id'=>0)));
			$categories[0] = "Default";
			$this->set('categories',$categories);
		
			if(!empty($id)){
				 // redirect to edit page
				 if(!empty($this->request->data)){
				 	  $validatedResponse = $this->Misc->validateData($this->request->data['Category'],array('name'=>'Name','status'=>'Status'));
					  if(count($validatedResponse)>0)
					  {
					  	$this->Flash->set( ucfirst(implode('<br/>',$validatedResponse)) , array('element' => 'warning'));	
					  }
					  else{
					  	 $this->request->data['Category']['alias'] = $this->Misc->slugify($this->request->data['Category']['name']);
					  	 $this->Category->create();
					  	 $this->Category->save(($this->request->data));
					  	 $this->Flash->set( "Category edited." , array('element' => 'success'));
					  	 $category = $this->Category->findById($id);
				 	     $this->request->data = $category;	
		 			  }
				 }else{
				 	$category = $this->Category->findById($id);
				 	$this->request->data = $category;
				 }
			}else{
				// redirect to add page 
				if(!empty($this->request->data)){
				  $validatedResponse = $this->Misc->validateData($this->request->data['Category'],array('name'=>'Namme','status'=>'Stus'));
				  if(count($validatedResponse)>0)
				  {
				  	$this->Flash->set( ucfirst(implode('<br/>',$validatedResponse)) , array('element' => 'warning'));	
				  }
				  else{
				  	 $this->request->data['Category']['alias'] = $this->Misc->slugify($this->request->data['Category']['name']);
				  	 $this->Category->create();
				  	 $this->Category->save(($this->request->data));
				  	 $this->Flash->set( "Category created." , array('element' => 'success'));
				  	 $category = $this->Category->findById($this->Category->getInsertID());
				 	 $this->request->data = $category;	
	 			  }
				}
			}
			
		}else{
		  return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
		}
	}

    public function admin_delete($id) {
      if($this->Session->read('ADMIN_USER')){
      	if(!empty($id)){
      		
			$deletedCategory = $this->Category->save(array('Category'=>array('id'=>$id,'deleted'=>'0')));
			if($deletedCategory){
				$this->Flash->set( "Category deleeted." , array('element' => 'success'));
			}else{
				$this->Flash->set( "Invalid data." , array('element' => 'warning'));
			}
			return $this->redirect(array('controller' => 'categories', 'action' => 'index','admin'=>true));	
		}else{
			return $this->redirect(array('controller' => 'categories', 'action' => 'index','admin'=>true));	
		}
      }else{
	  	return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
	  }
	}
	
	
}
?>
