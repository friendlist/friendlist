<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title_for_layout; ?></title>
    <meta name="author" content="<?php echo(Configure::read('site.author')); ?>">
    <meta name="generator" content="academic*">

    <!-- Styles -->
    <link href="<?php echo $this->Html->url('/css/bootstrap-test.css'); ?>" rel="stylesheet">
    <?php echo $scripts_for_layout; ?>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!--Load jQuery-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo $this->Html->url('/img/favicon.ico'); ?>">
    
  </head>
  
  <body style="background-color: #C0DEED; margin-top: 20px;">
  
  <?php 
  if ($this->Session->check('Auth.User.id')) {
  	echo $this->element('navbar_logged');
  } else {
  	echo $this->element('navbar_default');
  } ?>
  
  <div id="content">
    
    <div class="container" style="background-color: rgba(255, 255, 255, 0.55); padding: 40px 20px 0 20px; height: 100%; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; margin-bottom: 20px;">
    
		<div>	
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>	    
		</div>
      
    </div>
    
    <?php //echo $this->element('sql_dump'); ?>
    
</div> <!--/Content-->

<!-- Javascript --> 
<script src="<?php echo $this->Html->url('/js/bootstrap.js'); ?>"></script>
  
  </body>
  
</html>

<script type="text/javascript">
	$("[rel=tooltip]")
	      .tooltip({
	        placement: 'top'
	})
</script>

<script type="text/javascript">
	$("[rel=popover]")
	      .popover({
	        placement: 'right'
	})
</script>