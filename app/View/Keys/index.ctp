<?php $this->layout = 'manager'; ?>

<div class="well">

<h1>Registration keys</h1>

<hr>

<a class="btn" href="keys/addkey/">Add key</a>

<h3>Unused keys</h3>

<table class="table table-striped">

        <thead>
          <tr>
            <th>ID</th>
            <th>Value</th>
            <th>Generated</th>
          </tr>
        </thead>
        
        <tbody>
          <?php foreach ($keys as $key): ?>
          <tr>
            <td>#<?php echo $key['Key']['id']; ?></td>
            <td><code><?php echo $key['Key']['key']; ?></code></td>
            <td>date</td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

</div>