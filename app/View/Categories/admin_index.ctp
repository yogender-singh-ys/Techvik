<div class="content-box-large" style="margin: 0px;" >
	<h3 style="padding-bottom:  10px;">Manage Categories</h3>
	<p style="padding-bottom:  10px;" ><?php echo $this->Html->link('Add Category',array('controller' => 'categories','action' => 'add','admin' => true),array('class'=>'btn btn-info')); ?></p>
	
	

	<div class="content-box-large" style="margin-bottom: 0px;" >
	            <label  class="col-sm-12 control-label"><?php echo $this->Flash->render() ?></label>
  				<div class="panel-body">
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th>Name</th>
								<th>Sub-category</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						  <?php if(count($categories)>0){?>
						    <?php foreach($categories as $category ){ ?>
							   <tr class="odd gradeX">
								<td><?php echo $category['Category']['name'] ?></td>
								<td>Internet
									 Explorer 4.0</td>
								<td>
									<?php echo $this->Html->link('Edit',array('controller' => 'categories','action' => 'add/'.$category['Category']['id'],'admin' => true),array('class'=>'btn btn-warning')); ?>
									<?php echo $this->Html->link('Delete',array('controller' => 'categories','action' => 'delete/'.$category['Category']['id'],'admin' => true),array('class'=>'btn btn-danger')); ?>
								</td>
							   </tr>
							<?php } ?>
						  <?php }else{ ?>
						        <tr >
								  <td colspan="3">Add categories. :-)</td>
								</tr>
						  <?php } ?>
						</tbody>
					</table>
  				</div>
  			</div>
  			
</div>

