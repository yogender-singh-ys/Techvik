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
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           
	           <div class="col-md-10">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><?php echo $this->Html->link('Dashboard',array('controller' => 'pages','action' => 'dashboard','admin' => true)); ?></h1>
	                 
	              </div>
	           </div>
	           
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <?php echo $this->Html->link('Logout',array('controller' => 'pages','action' => 'logout','class'=>'dropdown-toggle','admin' => true)); ?>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	           
	        </div>
	     </div>
	</div>

    <div class="container">
    	<div class="row">
    	  
    	  <!-- menu container starts -->
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="#">Categories</a></li>
                    <li class="current"><a href="#">Articles</a></li>

                </ul>
             </div>
		  </div>
		  <!-- menu container ends -->
		  
		  <!-- Page container starts -->
		  <div class="col-md-10">
		  	<div class="row">
		  		<?php echo $this->fetch('content'); ?>
		  	</div>
		  </div>
		  <!-- Page container ends -->
		  
	 </div>
    </div>

    <!--<footer></footer>-->
    <?php echo $this->Html->script('admin/jquery.js'); ?>
    <?php echo $this->Html->script('admin/bootstrap.min'); ?>
    <?php echo $this->Html->script('admin/custom'); ?>
    
    <?php echo $this->Html->script('admin/jquery.dataTables.min'); ?>
<?php echo $this->Html->script('dataTables.bootstrap'); ?>
    
  </body>
</html>
