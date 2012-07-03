<?php $this->layout = 'homepage'; ?>

<!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" style="background-color: #ffffff; color: #333;">
        <h1>What are you playing?</h1>
        <p>Helps building community around your website by making users react to other people's status.</p>
        <p><a href="<?php echo $this->Html->url('/users/add/'); ?>" class="btn btn-large">Register</a> <a href="<?php echo $this->Html->url('/users/login/'); ?>" class="btn btn-large btn-success">Already a member ?</a></p>
      </div>
      
 <ul class="thumbnails" style="margin-bottom: 1(px;">
 <?php foreach ($users as $user): ?>
 
 <?php $gravatar = md5(strtolower(trim($user['User']['email']))); ?>
 
         <li class="span1">
           <a href="<?php echo $this->Html->url('/users/view/'.$user['User']['username']); ?>" class="thumbnail" rel="popover" data-content="<?php if (empty($user['User']['about'])) {
           	echo("This user has entered no description yet.");
           } else {
           	echo $user['User']['about'];
           } ?></br>
           <span class='muted'>Member since <?php echo $user['User']['created']; ?></span>" data-original-title="@<?php echo $user['User']['username']; ?>">
             <img src="http://www.gravatar.com/avatar/<?php echo $gravatar ?>?s=55" alt="">
           </a>
         </li>
         
 <?php endforeach; ?>

 </ul>

<?php echo $this->element('footer'); ?>