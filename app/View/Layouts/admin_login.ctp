<!DOCTYPE html>
<html>
  <head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo $this->Html->css('admin/bootstrap.min'); ?>
    <?php echo $this->Html->css('admin/styles'); ?>
    <!-- styles -->
  

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body >
  	<div class="header">
	     <div class="container"> 
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">Admin</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</div>



    
    <?php echo $this->Html->script('admin/jquery.js'); ?>
    <?php echo $this->Html->script('admin/bootstrap.min'); ?>
    <?php echo $this->Html->script('admin/custom'); ?>
  </body>
</html>
