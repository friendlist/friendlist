<?php $this->layout = 'manager'; ?>

<div class="row">

  <div class="span4">

	
	<div class="well">
	<h6>News</h6>
	<p>Beta launching soon.</p>
	</div>
	
	<?php echo $this->element('footer'); ?>
	
  </div>
  
  
  <div class="span7">

  	      
  	<div class="well" style="padding: 20px 20px 20px 20px;">
  	
  	<h6>Timeline</h6>
  	
  	<hr>
  	
	  	<div id="main_content">
	  	
	  	<?php foreach ($posts as $post): ?>
	  	  		
	  	  		<?php $gravatar = md5(strtolower(trim($post['User']['email']))); ?>
	  	  				  
	  	  				  		  	<img src="http://www.gravatar.com/avatar/<?php echo $gravatar ?>?s=55" height="55" width="55" style="float:left; margin-right: 15px; border: 1px solid #dedede; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px;" alt="" />
	  	  				  		  	
	  	  				  		  	<?php 
	  	  				  		  	if (($post['Post']['comment_count']) >= '4') {
	  	  				  		  		echo("<span class='label label-important' style='float:right; margin-left:5px;'><i class='icon-fire icon-white'></i> epic</span>");
	  	  				  		  	} elseif (($post['Post']['comment_count']) >= '2') {
	  	  				  		  		echo("<span class='label label-warning' style='float:right; margin-left:5px;'><i class='icon-fire icon-white'></i> popular</span>");
	  	  				  		  		
	  	  				  		  	} ?>
	  	  				  		  	
	  	  				  		  	<?php 
	  	  				  		  	if (!empty($post['Post']['pic_url'])) {
	  	  				  		  	$picture = $post['Post']['pic_url'];
	  	  				  		  		echo("<span class='label label-info' style='float:right; margin-left:5px;'><i class='icon-picture icon-white'></i> pic</span>");
	  	  				  		  	} ?>
	  	  				
	  	  				  		  	<h4><a href="<?php echo $this->Html->url('/'); ?>users/view/<?php echo $post['User']['username']; ?>">@<?php echo $post['User']['username']; ?></a></h4>
	  	  				  		  	<?php echo $post['Post']['status']; ?> <a href="<?php echo $this->Html->url('/posts/search/'); ?><?php echo $post['Post']['game_name']; ?>"><?php echo $post['Post']['game_name']; ?></a> on <a href="<?php echo $this->Html->url('/'); ?>platforms/view/<?php echo $post['Platform']['name_abr']; ?>"><?php echo $post['Platform']['name_full']; ?></a></br>
	  	  				  		  	<div id="PostMenu<?php echo $post['Post']['id']; ?>"><p style="margin-bottom: 0px;"><small><a class="accordion-toggle" data-toggle="collapse" data-parent="PostMenu<?php echo $post['Post']['id']; ?>" href="#collapsePost<?php echo $post['Post']['id']; ?>"><i class="icon-plus-sign"></i> More</a> - <a href="<?php echo $this->Html->url('/posts/view/'); ?><?php echo $post['Post']['id']; ?>"><i class="icon-comment"></i> Comment (<?php echo $post['Post']['comment_count']; ?>)</a> - <a href="#"><i class="icon-retweet"></i> Share</a></small></p></div>
	  	  		
	  	  			    <div id="collapsePost<?php echo $post['Post']['id']; ?>" class="collapse" style="height: 0px;">
	  	  			    <hr>
	  	  			    <?php if (!empty($post['Post']['pic_url'])) {
	  	  			    $picture = $post['Post']['pic_url'];
	  	  			    	echo("<img src='$picture' style='margin-bottom:15px; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;' alt=''/>");
	  	  			    } ?>
	  	  			    <p style="margin-bottom: 0px;"><small>Posted <?php echo $post['Post']['created']; ?></small></p>
	  	  			    </div>
	  	  		  	  		  	  	
	  	  		  	<hr>
	  	  		
	  	<?php endforeach; ?>
	  	
	  	</div> <!--Main content-->
  	
  	</div> <!--Well-->

  </div> <!--Span 7-->
  
  <div class="span11">
  <ul class="thumbnails">
          <li>
            <a href="#" class="thumbnail">
              <img src="http://media.psu.com/media/wallpapers/computer_0067.jpg" width="263" height="180" alt="">
            </a>
          </li>
          <li>
            <a href="#" class="thumbnail">
              <img src="http://www.gamemunition.com/wp-content/uploads/2011/01/Xbox-360-Slim.jpg" width="264" height="180" alt="">
            </a>
          </li>
          <li>
            <a href="#" class="thumbnail">
              <img src="http://static.pcinpact.com/images/bd/news/76375-wii.jpg" width="263" height="180" alt="">
            </a>
          </li>
          <li>
            <a href="#" class="thumbnail">
              <img src="http://www.dragon-ball-z.org/jeuxvideos/images/console-psp.jpg" width="263" height="180" alt="">
            </a>
          </li>
          <li>
            <a href="#" class="thumbnail">
              <img src="http://www.cnetfrance.fr/cnet/i/edit/2012/02/ps-vita-tablettes-smartphones.jpg" width="264" height="180" alt="">
            </a>
          </li>
          <li>
            <a href="#" class="thumbnail">
              <img src="http://www.play3-live.com/news/dgg-1340787645.jpg" width="263" height="180" alt="">
            </a>
          </li>
          
   </ul>
   </div>
  
</div> <!--Row-->