<?php $gravatar = md5(strtolower(trim($this->Session->read('Auth.User.email')))); ?>
<div class="well">
<img src="http://gravatar.com/avatar/<?php echo $gravatar ?>?s=35" width="35" height="35" style="float: left; margin-right: 10px; border: 1px solid #dedede; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px;" alt="" />
<h4>@<?php echo $this->Session->read('Auth.User.username'); ?></h4>
<p style="margin-bottom: 0px;"><small><a href="<?php echo $this->Html->url('/users/view/'.$this->Session->read('Auth.User.username')); ?>">View my profile page</a></small></p>

<table class="table" style="margin-top: 20px;">
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