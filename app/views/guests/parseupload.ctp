<div>
	<h2 style="margin: .5em 0;">Import Accounts from and Excel File</h2>
	<p>For instructions on using the import feature and proper text formatting, <a href="/pages/importinfo" target="blank">click here</a>.</p>
	<br/>
<?php
	echo $form->create('Guest', array('action' => 'parseupload', 'enctype' => 'multipart/form-data') );
	echo $form->input('fn_column',array('value'=>'A','label'=>'First Name Column: '));
	echo $form->input('ln_column',array('value'=>'B','label'=>'Last Name Column: '));
	echo $form->file('Guest.submittedfile');
	echo $form->end('Upload');
?>
</div>