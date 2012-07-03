 <script>
    function DisableButton(b)
    {
       b.disabled = true;
       b.value = 'Unfollowing...';
       b.form.submit();
    }
 </script>
 
 <?php
 echo $this->Form->create('User', array(
 	'class' => 'form-inline',
 	'style' => 'margin-bottom:0px;',
 	'action' => 'unfollow/'.$row_id['0'],
 	'inputDefaults' => array(
 	    'label' => false,
 ) ));
 	
 echo ("<input type='submit' class='btn btn-danger' value='Stop following this user' onclick='DisableButton(this);'>"); ?>
 
 </form>