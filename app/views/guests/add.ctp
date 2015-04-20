<h1 style="text-align:center;" class="cursive">Austin & Ashleigh's Wedding</h1>
<hr style="width:520px;color:#888888;height:0px;"/>

<div style="padding:12px;margin-left:30px;">
    <h3>Add a Guest</h3>
    <div style="width:400px;"><?php echo $session->flash(); ?></div>
    <a href="/guests/view_all">Back to Dashboard</a><br/><br/>
    <?php
        echo $form->create('Guest', array('action' => 'add'));
        echo $form->input('first_name', array( 'label' => 'First Name: ','legend'=>false)).'<br/>';
        echo $form->input('last_name', array( 'label' => 'Last Name: ','legend'=>false)).'<br/>';
        echo $form->input('party_id', array( 'label' => 'Party: ','legend'=>false,'options'=>$parties)).'<br/>';
        echo $form->end(array('value'=>'Submit','style'=>'width:160px;margin-left:40px;'));
    ?>
</div>