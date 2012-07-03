<script>
   function DisableButton(b)
   {
      b.disabled = true;
      b.value = 'Following...';
      b.form.submit();
   }
</script>

<?php
echo $this->Form->create('User', array(
	'class' => 'form-inline',
	'style' => 'margin-bottom:0px;',
	'action' => 'follow/'.$user['User']['id'],
	'inputDefaults' => array(
	    'label' => false,
) ));

echo $this->Form->input('UsersUsers.follower_id',array(
	'type' => 'hidden',
	'value' => $this->Session->read('Auth.User.id'),
	));

echo $this->Form->input('UsersUsers.following_id',array(
	'type' => 'hidden',
	'value' => $user['User']['id'],
	));
	
echo ("<input type='submit' class='btn btn-success' value='Follow this user' onclick='DisableButton(this);'>"); ?>

</form>