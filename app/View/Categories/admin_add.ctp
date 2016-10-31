<div class="content-box-large" style="margin: 0px;" >
	<h3 style="padding-bottom:  10px;"><?php if( $this->request->data['Category']['id'] != "" ) {?>Edit Category<?php }else{ ?>Add Category<?php } ?></h3>
	<p style="padding-bottom:  10px;" ><?php echo $this->Html->link('Back',array('controller' => 'categories','action' => 'index','admin' => true),array('class'=>'btn btn-info')); ?></p>

	<div class="row">
	   <div class="col-md-8">
	  	   <div class="content-box-large">
			  	<div class="panel-body">
			  	       
			  	        <div class="form-group">
						    <label  class="col-sm-12 control-label"><?php echo $this->Flash->render() ?></label>
					    </div>
			  				
			  		   <?php echo $this->Form->create('Category', array('url' => array('action' => 'categories', 'action' => 'add','admin'=>true),"class"=>"'form-horizontal","role"=>"form")); ?>
			  		      
			  		      <?php echo $this->Form->hidden('id') ?>
			  		      
			  		      
			  					
						  <div class="form-group">
						    <label  class="col-sm-3 control-label">Category Name <span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->input('name', array('type' => 'text',"label"=>false,"div"=>false,"class"=>"form-control"));  ?>
						    </div>
						  </div>
						  
						  <?php if(!empty($this->request->data['Category']['id'])){ ?>
						      &nbsp;
							  <div class="form-group">
							    <label  class="col-sm-3 control-label">Category Alias</label>
							    <div class="col-sm-9">
							      <?php echo $this->request->data['Category']['alias'] ?>
							    </div>
							  </div>
						  <?php } ?>
						  &nbsp;
						  <div class="form-group">
						    <label  class="col-sm-3 control-label">Category Desciprion</label>
						    <div class="col-sm-9">
						      <?php echo $this->Form->textarea('description', array("label"=>false,"div"=>false,"class"=>"form-control"));  ?>
						    </div>
						  </div>
						  
						  <?php if($this->request->data['Category']['category_id'] != "0"){ ?>
						   &nbsp;
						    <div class="form-group">
						    <label  class="col-sm-3 control-label">Sub-Category type<span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php $options = array("1"=>"Active","0"=>"Disabled"); ?>
						      <?php echo $this->Form->input('category_id', array('options' => $categories,
						                                                   "label"=>false,
						                                                   "div"=>false,
						                                                   "class"=>"form-control" ));   ?>
						    </div>
						  </div>
						  <?php }else{ ?>
						   &nbsp;
						   <div class="form-group">
						    <label  class="col-sm-3 control-label">Sub-Category<span style="color:red">*</span></label>
						    <div class="col-sm-9">
						      <?php echo $categories[$this->request->data['Category']['category_id']]; ?>
						      
						    </div>
						   </div> 
						  <?php } ?>
						  
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
						   <label class="col-sm-12 control-label"><span style="color:red">(*) marked fields are mandatory. </span></label>
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
	  	</div>			
	</div>
  			
</div>

