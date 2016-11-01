<div class="content-box-large" style="margin: 0px;" >
	<h3 style="padding-bottom:  10px;"><?php if( $this->request->data['Article']['id'] != "" ) {?>Edit Article<?php }else{ ?>Add Article<?php } ?></h3>
	<p style="padding-bottom:  10px;" ><?php echo $this->Html->link('Back',array('controller' => 'articles','action' => 'index','admin' => true),array('class'=>'btn btn-info')); ?></p>

	<div class="row">
	   <div class="col-md-8">
	  	   <div class="content-box-large">
			  	<div class="panel-body">
			  	       
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
						      <?php echo $this->Form->input('content', array('type' => 'text',"label"=>false,"div"=>false,"class"=>"form-control"));  ?>
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
	  	</div>			
	</div>
  			
</div>

