<?php $this->layout = 'manager'; ?>

<div class="row">

  <div class="span4">

	<div class="well">
	<h6>Attached media</h6>
	<hr>
	<?php 
	if (!empty($post['Post']['pic_url'])) {
	$picture = $post['Post']['pic_url'];
	$picture_delete = $post['Post']['pic_delete'];
		echo("<a href='$picture_delete'><img src='$picture' style='-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px;' alt=''></a>");
	} else {
		echo("No attached media.");
	} ?>
	    
	</div>
	
	<?php echo $this->element('footer'); ?>
	
  </div><!--end span3-->
  
  <div class="span7">
  		<div class="well" style="padding: 20px 20px 20px 20px;">
  		
  		<h6>Original post</h6>
  		
  		<hr>

	<?php $gravatar = md5(strtolower(trim($post['User']['email']))); ?>
	
			  	<img src="http://www.gravatar.com/avatar/<?php echo $gravatar ?>?s=55" height="55" width="55" style="float:left; margin-right: 10px; border: 1px solid #dedede; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px;" alt="" />
			  	
			  	<h4><a href="<?php echo $this->Html->url('/'); ?>users/view/<?php echo $post['User']['username']; ?>">@<?php echo $post['User']['username']; ?></a></h4>
			  	<?php echo $post['Post']['status']; ?> <?php echo $post['Post']['game_name']; ?> on <a href="<?php echo $this->Html->url('/'); ?>platforms/view/<?php echo $post['Platform']['name_abr']; ?>"><?php echo $post['Platform']['name_full']; ?></a></br>
			  	<p style="margin-bottom: 0px;"><small>Posted <?php echo $post['Post']['created']; ?></small></p
		
			</div>
	
	</div>
	
	
	<div class="well">
	
			<h6>Comments (<?php echo $post['Post']['comment_count']; ?>)</h6>
			
			<hr>
			
			<?php if (empty($post['Comment'])) {
				echo("There is no comment for this post yet.<hr>");
			} ?>
	
			<?php foreach ($post['Comment'] as $comment): ?>
			<?php $gravatar = md5(strtolower(trim($comment['User']['email']))); ?>
			

				<img src="http://www.gravatar.com/avatar/<?php echo $gravatar ?>?s=55" height="55" width="55" style="float:left; margin-right: 10px; border: 1px solid #dedede; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px;" alt="" />
				
				<h4><a href="<?php echo $this->Html->url('/'); ?>users/view/<?php echo($comment['User']['username']) ?>">@<?php echo($comment['User']['username']) ?></a></h4>
				<?php $comment_content = preg_replace('/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '$1<a href="/users/view/$2">@$2</a>', $comment['content']) ?>
				<?php echo $comment_content; ?>
				<p style="margin-bottom: 0px;"><small>Posted <?php echo($comment['created']) ?></small></p>
				<hr>
			
			<?php endforeach; ?>
			
			<form class="form-inline" action="/manager/comments/add" method="post" style="margin-bottom: 0px;">
			        <input type="text" name="data[Comment][content]" class="input" id="content" style="width:450px;">
			        <input type="hidden" name="data[Comment][post_id]" class="input" id="post_id" value="<?php echo $post['Post']['id']; ?>">
			        <button type="submit" class="btn" rel='tooltip' data-original-title='Add a comment'><i class="icon-ok"></i></button>
			 </form>

	</div>


  </div><!--end span8-->
  
</div><!--end row-->
