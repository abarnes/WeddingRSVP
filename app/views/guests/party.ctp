<h1 style="text-align:center;" class="cursive">Austin & Ashleigh's Wedding</h1>
<hr style="width:520px;color:#888888;height:0px;"/>

<div style="padding:12px;margin-left:30px;">
    <p style="font-size:120%">Others in your party:</p>
    <div style="width:400px;"><?php echo $session->flash(); ?></div>
    <?php echo $form->create('Guest', array('action' => 'party/'.$guest['Guest']['id'])); ?>
        <?php foreach ($others as $o) { ?>
            <p style="font-size:1.3em;"><?php echo $o['Guest']['full_name']; ?></p>
            <?php echo $form->input('sel'.$o['Guest']['id'], array( 'label' => $o['Guest']['full_name'],'legend'=>false,'separator'=>'<br/>','options'=>array('1'=>'Attending','2'=>'Not Attending'),'type'=>'radio')).'<br/>'; ?>
        <?php } ?>
    <?php echo $form->end(array('value'=>'Submit','style'=>'width:160px;margin-left:40px;')); ?>
</div>