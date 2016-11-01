<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<script>
	$( document ).ready(function() {
        $('.outer_checkbox').change(function () {
        	var id_val = $(this).attr('role');
		    if ($(this).prop('checked')) {
		    	var class_name = '.innner_checkbox_'+id_val;
		        $(class_name).prop('checked', true);
		    }
		    else {
		    	var class_name = '.innner_checkbox_'+id_val;
		        $(class_name).prop('checked', false);
		    }
		});
		
		CKEDITOR.replace( 'ArticleContent' );
    });
</script>
<div class="content-box-large" style="margin: 0px;" >
	<h3 style="padding-bottom:  10px;"><?php if( $this->request->data['Article']['id'] != "" ) {?>Edit Article<?php }else{ ?>Add Article<?php } ?></h3>
	<p style="padding-bottom:  10px;" ><?php echo $this->Html->link('Back',array('controller' => 'articles','action' => 'index','admin' => true),array('class'=>'btn btn-info')); ?></p>

	<div class="row">
	   <div class="col-md-12">
	  	   <!-- Information Section starts-->
	  	    <div class="content-box-large">
			  	<div class="panel-body">
			  	
			  	        <div class="form-group">
						    <label  class="col-sm-12 control-label"><h4>General </h4></label>
					    </div>
			  	       
			  	        <div class="form-group">
						    <label  class="col-sm-12 control-label"><?php echo $this->Flash->render() ?></label>
					    </div>
			  				
			  		   <?php echo $this->Form->create('Article', array('url' => array('action' => 'articles', 'action' => 'add','admin'=>true),"class"=>"'form-horizontal","role"=>"form")); ?>
			  		      
			  		      <?php echo $this->Form->hidden('id') ?>
			  		      
			  		      
			  					
						  <div class="form-group">
						    <label  class="col-sm-3 control-label">Headline<span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->input('headline', array('type' => 'text',"label"=>false,"div"=>false,"class"=>"form-control"));  ?>
						    </div>
						  </div>
						  
						  <?php if(!empty($this->request->data['Article']['id'])){ ?>
						      &nbsp;
							  <div class="form-group">
							    <label  class="col-sm-3 control-label">Article Alias</label>
							    <div class="col-sm-9">
							      <?php echo $this->request->data['Article']['alias'] ?>
							    </div>
							  </div>
						  <?php } ?>
						  
						  &nbsp;
						  <div class="form-group">
						    <label  class="col-sm-3 control-label">Sub-Headline<span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->input('subheadline', array('type' => 'text',"label"=>false,"div"=>false,"class"=>"form-control"));  ?>
						    </div>
						  </div>
						  
						  &nbsp;
						  <div class="form-group">
						    <label  class="col-sm-3 control-label">Webpage title<span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->input('page_title', array('type' => 'text',"label"=>false,"div"=>false,"class"=>"form-control"));  ?>
						    </div>
						  </div>
						  
						  &nbsp;
						  <div class="form-group">
						    <label  class="col-sm-3 control-label">Keywords<span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->input('keywords', array('type' => 'text',"label"=>false,"div"=>false,"class"=>"form-control"));  ?>
						    </div>
						  </div>
						  
						  &nbsp;
						  <div class="form-group">
						    <label  class="col-sm-3 control-label">Meta Description<span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->input('meta_desc', array('type' => 'text',"label"=>false,"div"=>false,"class"=>"form-control"));  ?>
						    </div>
						  </div>
						  
						  &nbsp;
						  <div class="form-group">
						    <label  class="col-sm-3 control-label">content<span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->input('content', array('type' => 'textarea',"label"=>false,"div"=>false,"class"=>"form-control"));  ?>
						    </div>
						  </div>
						  
						  &nbsp;
						  <div class="form-group">
						    <label  class="col-sm-3 control-label">Status <span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php $options = array("1"=>"Active","0"=>"Disabled"); ?>
						      <?php echo $this->Form->input('status', array('options' => $options,
						                                                   "label"=>false,
						                                                   "div"=>false,
						                                                   "class"=>"form-control" ));   ?>
						    </div>
						  </div>
						  
						  &nbsp;
						  <div class="form-group">
						    <label  class="col-sm-3 control-label"></label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->submit('Add', array("label"=>false,"div"=>false,"class"=>"btn btn-info"));  ?>
						    </div>
						  </div>	
						  
						  
						  				 
								  
						<?php echo $this->Form->end(); ?>  
								
								
			  	</div>
			</div>
           <!-- Information Section ends-->
            
           <!-- Category Section starts-->
           <?php if($this->request->data['Article']['id']){ ?>
           <?php if(count($categories)>0){ ?>
           <div class="content-box-large">
		     <div class="panel-body">
			    <label  class="col-sm-12 control-label"><h4>Category </h4></label>
			    <?php echo $this->Form->create(null, array('url' => array('controller' => 'articles', 'action' => 'categories','admin'=>true),"class"=>"'form-horizontal","role"=>"form")); ?> 
			    
			    
			    
			    &nbsp;
				 <?php echo $this->Form->hidden('article_id',array('value'=>$this->request->data['Article']['id'])); ?>
				 <div class="col-sm-12" style="text-align: left">
				   <?php 
				       $category_counter = 1;
				       foreach ($categories as $category) {  ?>
				       
				       <div class="col-sm-3" style="padding-bottom: 10px; ">
				           <label>
				             
				            <?php if(in_array($category['Category']['id'],$selectedCategories)){ ?>
				         	   <?php echo $this->Form->checkbox('category.'.$category['Category']['id'],array("class"=>"outer_checkbox","role"=> $category['Category']['id'],'checked'=>true)); ?>
				         	<?php }else{ ?>
				         	    <?php echo $this->Form->checkbox('category.'.$category['Category']['id'],array("class"=>"outer_checkbox","role"=> $category['Category']['id'])); ?>
				         	<?php } ?>
				         	<?php echo $category['Category']['name']?>
				           </label>
				           <?php foreach ($category['Categories'] as $sub_category){ ?>
				             <label style="padding-left: 30px;">
				               <?php if(in_array($sub_category['id'],$selectedCategories)){ ?>
				                  <?php echo $this->Form->checkbox('category.'.$sub_category['id'],array("class"=>"innner_checkbox_".$category['Category']['id'],'checked'=>true)); ?>
				               <?php }else{ ?>
				                  <?php echo $this->Form->checkbox('category.'.$sub_category['id'],array("class"=>"innner_checkbox_".$category['Category']['id'])); ?>
				               <?php } ?>
				             	
				         	    <?php echo $sub_category['name']; ?>
				             </label>
				           <?php  } ?>
				       </div>
				       <?php if( $category_counter == 4){echo '</div><div class="col-sm-12" style="text-align: center" >'; $category_counter = 0; }else{$category_counter++;} ?>
			        
			     <?php  } ?>			
			    </div>
			    
			    <div class="form-group">
			       <label  class="col-sm-12 control-label" style=" ">Please make sure to add a category to your Article</label>
		        </div>
			    
			    &nbsp;
			    <div class="form-group">
			     
			      <div class="col-sm-9">
			        <?php echo $this->Form->submit('Add', array("label"=>false,"div"=>false,"class"=>"btn btn-info"));  ?>
			      </div>
			    </div>
			    
			    <?php echo $this->Form->end(); ?>
			 </div>
		   </div> 	    
           <?php } ?>
           <?php } ?>
		   <!-- Category Section ends-->
           

           <!-- Video Section starts-->
           <?php if($this->request->data['Article']['id']){ ?>
           
           <div class="content-box-large">
			  	<div class="panel-body">
			  	
			  	        <div class="form-group">
						    <label  class="col-sm-12 control-label"><h4>Video </h4></label>
					    </div>
			  				
			  		   <?php echo $this->Form->create('Video', array('url' => array('controller' => 'articles', 'action' => 'videos','admin'=>true),"class"=>"'form-horizontal","role"=>"form")); ?> 
			  		      
			  		      <?php echo $this->Form->hidden('video_id',array('value'=>$this->request->data['Article']['id'])); ?>
			  		      
			  		      
			  					
						  <div class="form-group">
						    <label  class="col-sm-3 control-label">Video keys<span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->input('video_keys', array('type' => 'text',"label"=>false,"div"=>false,"class"=>"form-control"));  ?>
						    </div>
						  </div>
						  
						  <div class="form-group">
						    <label  class="col-sm-12 control-label" style=" ">Add comma(,) seperated YouTube videos keys</label>
					      </div>
					      
					      &nbsp;
						  <div class="form-group">
						    <label  class="col-sm-3 control-label"></label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->submit('Add', array("label"=>false,"div"=>false,"class"=>"btn btn-info"));  ?>
						    </div>
						  </div>
						   			 
								  
						<?php echo $this->Form->end(); ?>  
						
						<?php if(count($videos)>0){ ?>
						&nbsp;
						<div class="col-sm-12" style="text-align: center">
						   <?php 
						       $video_counter = 1;
						       foreach ($videos as $video) {  ?>
						       
						       <div class="col-sm-3" style="padding-bottom: 10px;">
						        <img src="http://img.youtube.com/vi/<?php echo $video['Video']['youtube_key']; ?>/hqdefault.jpg" width="100%" > 
						        <?php echo $this->Html->link('Delete',array('controller' => 'articles','action' => 'deletevideo/'.$video['Video']['id'],'admin' => true),array('class'=>'')); ?> | 
						        <a href="https://www.youtube.com/watch?v=<?php echo $video['Video']['youtube_key']; ?>" target="_blank" >Youtube</a>
						       </div>
						       <?php if( $video_counter == 4){echo '</div><div class="col-sm-12" style="text-align: center" >'; $video_counter = 0; }else{$video_counter++;} ?>
					        
					     <?php  } ?>			
					   </div>	
					   <?php  } ?>
			  	</div>
			</div>
		   <?php } ?>
		   <!-- Video Section ends-->
		   
		   
		   <!-- Image Section starts-->
		   <?php if($this->request->data['Article']['id']){ ?>
           
           <div class="content-box-large">
		     <div class="panel-body">
			    <label  class="col-sm-12 control-label"><h4>Images</h4></label>
			    
			    <?php echo $this->Form->create('Images', array('type' => 'file','url' => array('controller' => 'articles', 'action' => 'images','admin'=>true),"class"=>"'form-horizontal","role"=>"form")); ?> 
			    
			    
				<?php echo $this->Form->hidden('article_id',array('value'=>$this->request->data['Article']['id'])); ?>
				
				<div class="form-group">
				    <label  class="col-sm-3 control-label">Video keys<span style="color:red">*</span></label>
				    <div class="col-sm-9">
				      <?php echo $this->Form->input('images][', array('type' => 'file',"label"=>false,"div"=>false,"class"=>"form-control","multiple","multiple"));  ?>
				    </div>
				 </div>
			    
			    
			    &nbsp;
			    <div class="form-group">
			     
			      <div class="col-sm-9">
			        <?php echo $this->Form->submit('Add', array("label"=>false,"div"=>false,"class"=>"btn btn-info"));  ?>
			      </div>
			    </div>
			    
			    <?php echo $this->Form->end(); ?>
			 </div>
		   </div> 	    
           
           <?php } ?>
		   <!-- Image Section ends-->
		   
		   
		   
	  	</div>			
	</div>
  			
</div>

