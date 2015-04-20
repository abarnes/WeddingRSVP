<h1 style="text-align:center;" class="cursive">Austin & Ashleigh's Wedding</h1>
<hr style="width:520px;color:#888888;height:0px;"/>

<div style="padding:12px;margin-left:30px;">
    <p>To RSVP for the wedding, please enter your name.</p>
    <div style="width:400px;"><?php echo $session->flash(); ?><br/></div>
    <?php
        echo $form->create('Guest', array('action' => 'search'));
        echo $form->input('name', array( 'label' => 'Name','class'=>'wid')).'<br/>';
        echo $form->end(array('value'=>'Submit','style'=>'width:316px;margin-left:60px;'));
    ?>
</div>