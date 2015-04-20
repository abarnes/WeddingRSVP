<script type="text/javascript">
/*
$(document).ready(function() {  
    var max = 0;  
    $("label").each(function(){  
        if ($(this).width() > max)  
            max = $(this).width();  
    });  
    $("label").width(max);  
});*/
</script>

<h1 style="text-align:center;" class="cursive">Austin & Ashleigh's Wedding</h1>
<hr style="width:520px;color:#888888;height:0px;"/>

<div style="padding:12px;margin-left:30px;">
    <p style="font-size:120%"><?php echo $guest['Guest']['full_name']; ?></p>
    <p>Please select an option:</p>
    <div style="width:400px;"><?php echo $session->flash(); ?></div>
    <?php
        echo $form->create('Guest', array('action' => 'rsvp/'.$guest['Guest']['id']));
        echo $form->input('sel', array( 'label' => 'Name','legend'=>false,'separator'=>'<br/>','options'=>array('1'=>'Attending','2'=>'Not Attending'),'type'=>'radio')).'<br/>';
        echo $form->end(array('value'=>'Submit','style'=>'width:160px;margin-left:40px;'));
    ?>
</div>