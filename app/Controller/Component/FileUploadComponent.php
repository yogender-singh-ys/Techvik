<?php

App::uses('Component', 'Controller');


class FileUploadComponent extends Component {
	 //default settings
	  private $destination = null;
	  private $renameSlug = null;
	  
	  private $maxSize = '1048576'; 
	  private $allowedExtensions = array('image/jpeg','image/png','image/gif','image/bmp'); // mime types
	  private $error = array();
	  private $status = true;
	  
	 
	  public function upload($images,$destination,$renameSlug){
	  	$this->renameSlug = $renameSlug;
	  	$this->destination = $destination;
	  	$originalImageName = array();
	  	if( (count($images)>0) && ($destination !="")  && ($renameSlug !="") ){
	  		
	  		foreach($images as $image){
				if($this->validateMime($image)){
					$renamedName = $this->renameImage($image);
					$originalImageName[] = $renamedName;
					if(is_string($renamedName)){
						$dir_load_path = WWW_ROOT.$this->destination.$renamedName;
						$this->moveFile($image,$dir_load_path);
					}
					
				}
			}
			
		   return array('status'=>$this->status,'error'=>$this->error,'images'=>$originalImageName);
	  	}else{ 
		   $error[] = "Invalid arguments";
		   return array('status'=>$this->status,'error'=>$this->error,'images'=>$originalImageName);
		}
	  }
	  
	  public function validateMime($image){
	  	if(!in_array($image['type'],$this->allowedExtensions)){
			  $error[] = $image['type']." is not supported file type.";
			  $this->status = false;
			  return false; 
		}else{
			  return true;
		}
	  }
	  
	  private function renameImage($image){
	  	if(!empty($image['name'])){
			$ext = explode('.',$image['name']);
			$ext_str = end($ext);
			$file_name = $this->renameSlug."_".substr(md5($image['name']),0,9).".".$ext_str;
			return $file_name;
		}else{
			 $this->status = false;
			 return false; 
		}
	  }
	  
	  private function moveFile($image,$destination){
	  	    if (move_uploaded_file($image["tmp_name"], $destination)) {
              return true;
		    } else {
		      $error[] = $image['type']." could not be uploaded.";
		      $this->status = false;
		      return false;
		    }
	  }
	 
	  
}

?>
