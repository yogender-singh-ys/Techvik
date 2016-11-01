<div class="content-box-large" style="margin: 0px;" >
	<h3 style="padding-bottom:  10px;">Manage Articles</h3>
	<p style="padding-bottom:  10px;" ><?php echo $this->Html->link('Add Articles',array('controller' => 'articles','action' => 'add','admin' => true),array('class'=>'btn btn-info')); ?></p>
	
	

	<div class="content-box-large" style="margin-bottom: 0px;" >
	            <label  class="col-sm-12 control-label"><?php echo $this->Flash->render() ?></label>
  				<div class="panel-body">
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								
								<th>Heading</th>
								<th>Category</th>
								<th>Video</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
						  <?php if(count($articles)>0){?>
						    <?php foreach($articles as $article ){ ?>
							   <tr class="odd gradeX">
								<td><h5><?php echo $article['Article']['headline'] ?></h5><?php echo $article['Article']['subheadline'] ?></td>
								<td><?php echo count($article['Categories']) ?></td>
								<td><?php echo count($article['Videos']) ?></td>
								<td>
									<?php echo $this->Html->link('Edit',array('controller' => 'articles','action' => 'add/'.$article['Article']['id'],'admin' => true),array('class'=>'btn btn-warning')); ?>
									<?php echo $this->Html->link('Delete',array('controller' => 'articles','action' => 'delete/'.$article['Article']['id'],'admin' => true),array('class'=>'btn btn-danger')); ?>
									
								</td> 
							   </tr>
							<?php } ?>
						  <?php }else{ ?>
						        <tr >
								  <td colspan="4">Add Articles :-)</td>
								</tr>
						  <?php } ?>
						</tbody>
					</table>
  				</div>
  			</div>
  			
</div>