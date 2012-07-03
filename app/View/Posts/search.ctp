<?php $this->layout = 'manager'; ?>

<div class="well">

<h1>Search posts by game name</h1>

<hr>

<h3><?php echo count($results) ?> Result(s) for "<?php echo $keyword ?>"</h3>

<hr>

		  <?php if (empty($results)) {
		  	echo("No results to display.");
		  }  ?>
          
          <?php foreach ($results as $post): ?>
          
          <?php $gravatar = md5(strtolower(trim($post['User']['email']))); ?>
          
          		  	<img src="http://www.gravatar.com/avatar/<?php echo $gravatar ?>?s=55" height="55" width="55" style="float:left; margin-right: 10px; border: 1px solid #dedede; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px;" alt="" />
          		  	
          		  	<h4><a href="<?php echo $this->Html->url('/'); ?>users/view/<?php echo $post['User']['username']; ?>">@<?php echo $post['User']['username']; ?></a> <small> - posted <?php echo $post['Post']['created']; ?></small></h4>
          		  	<?php echo $post['Post']['status']; ?> <a href="<?php echo $this->Html->url('/posts/search/'); ?><?php echo $post['Post']['game_name']; ?>"><?php echo $post['Post']['game_name']; ?></a> on <a href="<?php echo $this->Html->url('/'); ?>platforms/view/<?php echo $post['Platform']['name_abr']; ?>"><?php echo $post['Platform']['name_full']; ?></a></br>
          		  	<p><small><a href="<?php echo $this->Html->url('/posts/view/'); ?><?php echo $post['Post']['id']; ?>"><i class="icon-comment"></i> Comment (<?php echo $post['Post']['comment_count']; ?>)</a> - <a href="#"><i class="icon-retweet"></i> Share</a> <?php 
          		  	if (!empty($post['Post']['pic_url'])) {
          		  	$picture = $post['Post']['pic_url'];
          		  		echo(" -  <a href='$picture'><i class='icon-picture'></i> See attached picture</a>");
          		  	} ?></small></p>
          		  	
          		  	<hr>
          	

          <?php endforeach; ?>


</div>

<?php echo $this->element('footer'); ?>