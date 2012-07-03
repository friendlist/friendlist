<?php $this->layout = 'manager'; ?>

<div class="row">

<div class="span11">
	<div class="well">
	
		<div style="float: right; width: 180px; margin-top: 5px;">
		<table class="table">
		        <tbody>
		          <tr>
		            <td><h6>Total posts</h6></td>
		            <td><b><?php echo $user['User']['post_count'] ?></b></td>
		          </tr>
		          <tr>
		            <td><h6>Following</h6></td>
		            <td><b><?php echo count($user['Following']) ?></b></td>
		          </tr>
		          <tr style="border-bottom: 1px solid #dedede;">
		            <td><h6>Followers</h6></td>
		            <td><b><?php echo count($user['Follower']) ?></b></td>
		          </tr>
		        </tbody>
		</table>
		</div>
		<?php $gravatar = md5(strtolower(trim($user['User']['email']))); ?>
		<img src="http://www.gravatar.com/avatar/<?php echo $gravatar ?>?s=120" style="float: left; margin-right: 20px; border: 1px solid #dedede; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px;" width="120" height="120" alt="" />
		<h2>@<?php echo $user['User']['username']; ?> <small><?php if (!$this->Session->read('Auth.User.id')) {
				echo ("");
			} elseif ($user['User']['id'] == $this->Session->read('Auth.User.id')) {
			echo ("(this is you)");
		} elseif (in_array($this->Session->read('Auth.User.id'), $following_id)) {
				echo("(following you)");	
			} else {
				echo("(not following you)");
			} ?></small></h2>
		<p style="font-weight: 300; font-size: 1.2em; font-style: italic; color: #888;">
		<?php if (empty($user['User']['about'])) {
			echo("This user has entered no description yet.");
		} else {
			echo $user['User']['about'];
		} ?>
		</p>
		<p><span class="muted">Member since <?php echo $user['User']['created']; ?></span></p>
		
		<!--Follow-->
		<?php if (!$this->Session->read('Auth.User.id')) {
				echo ("<a class='btn btn-info' href='../../users/login/'>Please login to follow this user</a>");
			} elseif ($user['User']['id'] == $this->Session->read('Auth.User.id')) {
				echo ("<a class='btn disabled'>You can't follow yourself</a>");
			} elseif (in_array($this->Session->read('Auth.User.id'), $followers_id)) {
				echo $this->element('unfollow');	
			} else {
				echo $this->element('follow');
			} ?>
		<!--/Follow-->
			
	</div>
</div>

  <div class="span4">

	<div class="well">
	<p style="float: right;"><small><a>See all &rarr;</a></small></p>
	<h6>Following</h6>
	<hr>
	<?php 
		if (!empty($user['Following'])) {
			$i = 0;
			foreach ($user['Following'] as $following) { 
			if($i==10) break;
			$i++;
			?>
	
			<?php $gravatar = md5(strtolower(trim($following['email']))); ?>
			<a href="<?php echo $this->Html->url('/'); ?>users/view/<?php echo $following['username'] ?>">
			<img src="http://www.gravatar.com/avatar/<?php echo $gravatar ?>?s=44" height="44" width="44" style="margin-right: 2px; margin-bottom: 5px; border: 1px solid #dedede; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;" rel="tooltip" data-original-title="@<?php echo $following['username'] ?>" alt="" />
			</a>
			
			<?php }
		} else {
			echo ("This user doesn't follow anyone yet.");
		} ?>
	</div>
	
	<div class="well">
	<p style="float: right;"><small><a>See all &rarr;</a></small></p>
	<h6>Followers</h6>
	<hr>
	<?php 
		if (!empty($user['Follower'])) {
			$i = 0;
			foreach ($user['Follower'] as $follower) {  
			if($i==10) break;
			$i++;
			?>
	
			<?php $gravatar = md5(strtolower(trim($follower['email']))); ?>
			<a href="<?php echo $this->Html->url('/'); ?>users/view/<?php echo $follower['username'] ?>">
			<img src="http://www.gravatar.com/avatar/<?php echo $gravatar ?>" height="40" width="40" style="margin-right: 2px; margin-bottom: 5px; border: 1px solid #dedede; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;" rel="tooltip" data-original-title="@<?php echo $follower['username'] ?>" alt="" />
			</a>
				
			<?php }
		} else {
			echo ("This user isn't followed yet.");
		} ?>
	</div>
	
	<?php echo $this->element('footer'); ?>
	
  </div><!--end span3-->
  
  <div class="span7">

		<div class="well" style="padding: 20px 20px 20px 20px;">
		
		<h6>All posts</h6>
		
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
	 	lastX = currentX;
	 	page++;
	 	$("#busy-indicator").fadeIn();
	 	$.get('<?php echo $this->Html->url('/users/getmore_profile/'.$user['User']['username']); ?>/page:' + page, function(data) {
	 	$('#postList').append(data);
	 	var bi =  $("#busy-indicator");
	 	      bi.stop(true, true);
	 	      bi.fadeOut();
	 	});
	 	}
	 	}
	 	});
	 	</script>
		 
		 <?php echo $this->Js->writeBuffer(); ?>
		
		</div>

  </div><!--end span7-->
  
</div><!--end row-->