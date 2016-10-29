<div class="login-wrapper">
    <div class="box">
        <div class="content-wrap">
            <h6>Sign In</h6>
            
            <?php echo $this->Flash->render() ?>
             
            <?php echo $this->Form->create('User', array('url' => array('controller' => 'pages', 'action' => 'index','admin'=>true))); ?>
            
            
            <?php echo $this->Form->input('username', array('type' => 'text',"placeholder"=>"E-mail address","label"=>false,"div"=>false,"class"=>"form-control"));  ?>
            <?php echo $this->Form->input('password', array('type' => 'password',"placeholder"=>"Password","label"=>false,"div"=>false,"class"=>"form-control"));  ?>
            <?php echo $this->Form->input('Login', array('type' => 'submit',"label"=>false,"div"=>false,"class"=>"btn btn-primary signup"));  ?>
            
            <?php echo $this->Form->end(); ?>  
                         
        </div>
    </div>

</div>