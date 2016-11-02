<?php
App::uses('AppController', 'Controller');

class ArticlesController extends AppController {
	
	public $uses = array('Article','Video','Category','ArticleCategory','Image');
	public $components = array('Misc','FileUpload');
	
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
				 // extract already selected categories
				 $selectedCategories = $this->ArticleCategory->find('list',array('conditions'=>array('article_id'=>$id),'fields' => array('category_id')));
				 $this->set('selectedCategories',$selectedCategories);
				 // extrct all images
				 $images = $this->Image->find('all',array('conditions'=>array('article_id'=>$id))); 
				 //echo '<pre>'; print_r($images); die();
				 $this->set('images',$images);
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
		  
		  $validatedResponse = $this->Misc->validateData($this->request->data['Video'],array('video_id'=>'Video data','video_keys'=>'Video keys'));	
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
       if($this->Session->read('ADMIN_USER')){
       	   if(!empty($this->request->data)){
       	   	  $validatedResponse = $this->Misc->validateData($this->request->data['Article'],array('article_id'=>'Article data'));
       	   	  if( (count($validatedResponse)==0) && (count($this->request->data['category'])>0) ){
			  	// count category selected
			  	$selected_count = 0;
			  	$data = array();
			  	foreach($this->request->data['category'] as $key => $selected){
					if($selected == "1"){
						$selected_count++;
						$temp_array = array();
						$temp_array['ArticleCategory']['category_id'] = $key;
						$temp_array['ArticleCategory']['article_id'] = $this->request->data['Article']['article_id'];
						$data[] = $temp_array;
					}
				}
				if($selected_count>0){
					// delete are entries for article
					$this->ArticleCategory->deleteAll(array('article_id'=>$this->request->data['Article']['article_id']));
					$this->ArticleCategory->create();
					$this->ArticleCategory->saveAll($data);
					$this->Flash->set( "Categories updated." , array('element' => 'success'));	
		   	        return $this->redirect(array('controller' => 'articles', 'action' => 'add/'.$this->request->data['Article']['article_id'],'admin'=>true));
				}else{
					$this->Flash->set( "Please select at least one category." , array('element' => 'warning'));	
		   	        return $this->redirect(array('controller' => 'articles', 'action' => 'add/'.$this->request->data['Article']['article_id'],'admin'=>true));
				}
			  }else{
			  	$this->Flash->set( "Invalid Data 1" , array('element' => 'warning'));	
		   	    return $this->redirect(array('controller' => 'articles', 'action' => 'index','admin'=>true));	
			  }
       	   }else{
       	   	  $this->Flash->set( "Invalid Data " , array('element' => 'warning'));	
		   	  return $this->redirect(array('controller' => 'articles', 'action' => 'index','admin'=>true));	
		   }
       	
       }else{
	   	return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));	
	   }
	}
	
	public function admin_images() {
	  if($this->Session->read('ADMIN_USER')){
	  	 if(!empty($this->request->data['Images']['article_id'])){
		 	if(count($this->request->data['Images']['images'])>0){
		 		$imagesArray = $this->request->data['Images']['images'];
		 		$article = $this->Article->findById($this->request->data['Images']['article_id']);
				$uploadInfo = $this->FileUpload->upload($imagesArray,'img'.DS.'articles'.DS,$article['Article']['alias']);
				if( ($uploadInfo['status']) && (count($uploadInfo['error'])==0) && (count($uploadInfo['images'])>0) ){
					$data = array();
					foreach($uploadInfo['images'] as $img){
						$temp_array = array();
						$temp_array['Image']['path'] = $img;
						$temp_array['Image']['article_id'] = $this->request->data['Images']['article_id'];
						$data[] = $temp_array;
					}
					$this->Image->create();
					$this->Image->saveAll($data);
					$this->Flash->set( 'Images uploaded.' , array('element' => 'success'));	
		   	    	return $this->redirect(array('controller' => 'articles', 'action' => 'add/'.$this->request->data['Images']['article_id'],'admin'=>true));
					
				}else{
					$this->Flash->set( implode('<br/>',$uploadInfo['error']) , array('element' => 'warning'));	
		   	    	return $this->redirect(array('controller' => 'articles', 'action' => 'add/'.$this->request->data['Images']['article_id'],'admin'=>true));
				}
			}else{
				$this->Flash->set( "Please select at least one image to upload." , array('element' => 'warning'));	
		   	    return $this->redirect(array('controller' => 'articles', 'action' => 'add/'.$this->request->data['Images']['article_id'],'admin'=>true));
			}
		 }else{
		 	$this->Flash->set( "Invalid Data " , array('element' => 'warning'));	
		   	return $this->redirect(array('controller' => 'articles', 'action' => 'index','admin'=>true));	
		 }
	  }else{
	  	return $this->redirect(array('controller' => 'pages', 'action' => 'display','admin'=>false));
	  }
	  
	}


    public function admin_deleteimage($id) {
       if($this->Session->read('ADMIN_USER')){
       	  if(!empty($id)){
       	  	 $image = $this->Image->findById($id);
       	  	 //echo $video['Video']['article_id'];
       	  	 //echo '<pre>'; print_r($video); die();
		  	 unlink(WWW_ROOT.'img'.DS.'articles'.DS.$image['Image']['path']);
		  	 
		  	 $deleted = $this->Image->delete($id);
		  	 if($deleted){
			 	$this->Flash->set( "Image deleted." , array('element' => 'success'));	
		        return $this->redirect(array('controller' => 'articles', 'action' => 'add/'.$image['Image']['article_id'],'admin'=>true));
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

	
}
?>
