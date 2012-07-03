<div class="row">

  <div class="span4">
	<?php
	if ($this->Session->check('Auth.User.id')) {
		echo $this->element('menu_logged');
	} ?>
	
	<div class="well" style="text-align: justify;">
	<h6>Important notice</h6>
	
	<hr>
	
	<span class="muted">Please notice that some data including but not limited to who you are following and your followers may be wiped during beta testing.</span>
	</div>
	
	<?php echo $this->element('footer'); ?>
	
  </div>
  
  
  <div class="span7">
  	
  		<div class="well" style="padding: 20px 20px 20px 20px; font-size: 14px;">
  		
		  	<h6>Timeline</h6>
		  	
		  	<hr>
		  	
		  	 
		  	 <div id="postList">
		  	 <?php echo $this->element('posts'); ?>
		  	 </div>
		  	 
		  	 <!-- Loading gif -->
		  	 <div style="text-align: center;">
		  	 <?php echo $this->Html->image('loading.gif', array('id' => 'busy-indicator', 'width' => '40', 'height' => '40')); ?>
		  	 </div>
		  	 
		  	 <?php
		  	 $maxPage = $this->Paginator->counter('%pages%');
		  	 ?>
		  	 <script type="text/javascript">
		  	 var lastX = 0;
		  	 var currentX = 0;
		  	 var page = 1;
		  	 
		  	 $(window).scroll(function () {
		  	 if (page < <?php echo $maxPage;?>) {
		  	 	currentX = $(window).scrollTop();
		  	 if (currentX - lastX > 150 * page) {
		  	 	lastX = currentX - 150;
		  	 	page++;
		  	 	$("#busy-indicator").fadeIn();
		  	 	$.get('<?php echo $this->Html->url('/users/getmore_timeline/'.$this->Session->read('Auth.User.username')); ?>/page:' + page, function(data) {
		  	 	setTimeout(function(){
		  	 	$('#postList').append(data);
		  	 	var bi =  $("#busy-indicator");
		  	       bi.stop(true, true);
		  	       bi.fadeOut();
		  	 	}, 1000);
		  	 });
		  	 }
		  	 }
		  	 });
		  	 </script>
		  	 
		  	 <?php echo $this->Js->writeBuffer(); ?>
		  	
  		
  		</div>
  	
  </div>
  
</div>
