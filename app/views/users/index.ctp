<?php echo $this->Paginator->options(array('url' => $this->passedArgs)); ?>
<script type="text/javascript">
$(document).ready(function() {
  $('.co').corner();
});
</script>

<br/>

<div class="info">
    <h4>General Settings</h4>
    <?php echo $form->create('Setting', array('action' => 'edit')); ?>
    <?php echo $form->input('from_email', array( 'label' => '"From" email address: ')); ?>
    <?php echo $form->input('replyto_email', array( 'label' => '"Reply To" email address: ')); ?>
    <?php echo $form->input('site_url', array( 'label' => 'Listed Site URL: ')); ?>
    <?php echo $form->input('lead_price', array( 'label' => 'Price per Lead: $')); ?>
    <?php echo $form->input('id', array( 'type'=>'hidden')); ?>
    <?php echo $form->end('Save'); ?>
</div>

<h4>Manage Users</h4>
<a href="/users/add" style="text-decoration:none;"><div style="background-color:rgb(162,202,102);border:2px solid rgb(126,157,75);" class="approved co">
    <p style="color:white;">+ Add User</p>
</div></a>
<br/>

<table class="grid">
    <tr>
	<th>
            <?php echo $this->Paginator->sort('Username', 'User.username'); ?>
        </th>
	<th>
            <?php echo $this->Paginator->sort('Email', 'User.email'); ?>
        </th>
	<th class="hid">
            Actions
        </th>
    </tr>
    <?php
    $c = 1;
    foreach ($users as $u) {
	
	if ($c%2>0) {
	    $class = 'row1';
	} else {
	    $class = 'row2';
	}
	$c++;
    ?>
    <tr class="<?php echo $class; ?>">
	<td>
	    <?php echo $u['User']['username']; ?>
	</td>
	<td>
	    <?php echo $u['User']['email']; ?>
	</td>
        <td class="hid" style="width:300px;">
	    <a href="/users/edit/<?php echo $u['User']['id']; ?>" style="text-decoration:none;"><div class="but co">
	        <p style="color:white;">Edit</p>
	    </div></a>
	    <a href="/users/passwordchange/<?php echo $u['User']['id']; ?>" style="text-decoration:none;"><div class="but co" style="width:120px;">
	        <p style="color:white;">Change Password</p>
	    </div></a>
	    <a href="/users/delete/<?php echo $u['User']['id']; ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this?')"><div class="but co">
	        <p style="color:white;">Remove</p>
	    </div></a>
	    
            <?php //echo $html->link('Edit',array('action'=>'edit/'.$u['Category']['id'])); ?>
            <?php /*echo $html->link(
				'Delete', 
				array('controller'=>'clients','action'=>'delete/'.$u['Category']['id']), 
				null, 
				'Are You Sure You Want To Delete This Category?'
			);*/ ?>
        </td>
    </tr>
    <?php } ?>
</table>
<br/>

<div class="nav" style="text-align:center;width:100%;">
    <!-- Shows the page numbers -->
    <?php echo $this->Paginator->prev('<< Previous', null, null, array('class' => 'disabled')); ?>
    <?php echo $this->Paginator->numbers(); ?>
    <?php echo $this->Paginator->next('Next >>', null, null, array('class' => 'disabled')); ?>
    <br/>
    <!-- prints X of Y, where X is current page and Y is number of pages -->
    <?php echo $this->Paginator->counter(); ?>
</div>