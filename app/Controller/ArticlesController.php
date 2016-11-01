<?php
App::uses('AppController', 'Controller');

class ArticlesController extends AppController {
	
	public $uses = array('Article','Video','Category');
	public $components = array('Misc');
	
	public function admin_index(){
		if($this->Session->read('ADMIN_USER')){
			$this->layout = "admin_dashboard";
			$articles = $this->Article->find('all',array('conditions'=>array('deleted'=>1)));
			$this->set('articles',$articles);
		}else{
		  return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
		}
	}

    public function admin_add($id=""){
        if($this->Session->read('ADMIN_USER')){
			$this->layout = "admin_dashboard";
			
			if(!empty($id)){
				 // extract video data 
				 $videos = $this->Video->find('all',array('conditions'=>array('article_id'=>$id)));
				 $this->set('videos',$videos);
				 // extract category data
				 $categories = $this->Category->find('all',array('conditions'=>array('deleted'=>'1','category_id'=>'0')));
				 $this->set('categories',$categories); 
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

    public function admin_delete($id) {
      if($this->Session->read('ADMIN_USER')){
      	if(!empty($id)){
      		
			$deletedArticle = $this->Article->save(array('Article'=>array('id'=>$id,'deleted'=>'0')));
			if($deletedArticle){
				$this->Flash->set( "Article deleted." , array('element' => 'success'));
			}else{
				$this->Flash->set( "Invalid data." , array('element' => 'warning'));
			}
			return $this->redirect(array('controller' => 'articles', 'action' => 'index','admin'=>true));	
		}else{
			return $this->redirect(array('controller' => 'articles', 'action' => 'index','admin'=>true));	
		}
      }else{
	  	return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
	  }
	}

    public function admin_videos(){
      if($this->Session->read('ADMIN_USER')){
      	if(!empty($this->request->data)){
		  
		  $validatedResponse = $this->Misc->validateData($this->request->data['Video'],array('video_id'=>'Video data',''=>'Video keys'));	
		  if(count($validatedResponse)>0){
		  	if(!empty($this->request->data['Video']['video_id'])){
		  	  $this->Flash->set( ucfirst(implode('<br/>',$validatedResponse)) , array('element' => 'warning'));	
			  return $this->redirect(array('controller' => 'articles', 'action' => 'add/'.$this->request->data['Video']['video_id'],'admin'=>true));
			}else{
				$this->Flash->set( "Invalid Data provide video information in blank" , array('element' => 'warning'));	
			  return $this->redirect(array('controller' => 'articles', 'action' => 'index','admin'=>true));	
			}
		  }else{
		  	$keyArray = explode(',',str_replace(' ','',$this->request->data['Video']['video_keys']));
		  	$data = array();
		  	foreach($keyArray as $key){
				if(!empty(trim($key))){
					$tempArray = array();
					$tempArray['Video']['youtube_key'] = $key ;
					$tempArray['Video']['article_id'] = $this->request->data['Video']['video_id'] ;
					$data[] = $tempArray;
				}
			}
			$this->Video->create();
		    $this->Video->saveAll($data);
		    $this->Flash->set( "Video updated." , array('element' => 'success'));	
		    return $this->redirect(array('controller' => 'articles', 'action' => 'add/'.$this->request->data['Video']['video_id'],'admin'=>true));
		  }
			
		}else{
		  return $this->redirect(array('controller' => 'articles', 'action' => 'index','admin'=>true));		
		}
      }else{
	  	return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
	  }
	}

    public function admin_deletevideo($id) {
       if($this->Session->read('ADMIN_USER')){
       	  if(!empty($id)){
       	  	 $video = $this->Video->findById($id);
       	  	 //echo $video['Video']['article_id'];
       	  	 //echo '<pre>'; print_r($video); die();
		  	 $deleted = $this->Video->delete($id);
		  	 if($deleted){
			 	$this->Flash->set( "Video deleted." , array('element' => 'success'));	
		        return $this->redirect(array('controller' => 'articles', 'action' => 'add/'.$video['Video']['article_id'],'admin'=>true));
			 }else{
			 	$this->Flash->set( "Invalid data" , array('element' => 'warning'));	
		        return $this->redirect(array('controller' => 'articles', 'action' => 'index','admin'=>true));
			 }
		  }else{
		  	return $this->redirect(array('controller' => 'articles', 'action' => 'index','admin'=>true));	
		  }
       }else{
	   	return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
	   }
	}

    public function admin_categories() {
      echo '<pre>'; print_r($this->request->data); die();
	}
	
	
}
?>
