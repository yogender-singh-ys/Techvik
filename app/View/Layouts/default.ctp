<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <?php echo $this->Html->css('materialize/css/materialize.min',array("media"=>"screen,projection")); ?>
      <?php echo $this->Html->script('jquery-2.1.1.min'); ?>
      <?php echo $this->Html->script('materialize/js/materialize.min'); ?>
     
    </head>

    <body>
      
      
  
      <?php echo $this->fetch('content'); ?>
    
      
    </body>
  </html>
