<?php $this->layout = 'manager'; ?>

<div class="well">

<h1>Search users</h1>

<hr>

<h3>Results</h3>

<table class="table table-striped">

        <thead>
          <tr>
            <th>Avatar</th>
            <th>Username</th>
            <th>About</th>
            <th>Member since</th>
          </tr>
        </thead>
        
        <tbody>
          <?php foreach ($results as $user): ?>
          <?php $gravatar = md5(strtolower(trim($user['User']['email']))); ?>
          <tr>
            <td><img src="http://gravatar.com/avatar/<?php echo $gravatar ?>" height="20" width="20" alt="" /></td>
            <td><a>@<?php echo $user['User']['username']; ?></a></td>
            <td><?php if (empty($user['User']['about'])) {
            	echo("This user has entered no description yet.");
            } else {
            	echo $user['User']['about'];
            } ?></td>
            <td><span class="muted"><?php echo $user['User']['created']; ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

</div>