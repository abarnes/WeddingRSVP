<h1 style="margin-left:20px;">Ashleigh & Austin's Wedding - Dashboard</h1>
<h4><?php echo $session->flash(); ?></h4>

<div style="float:left;">
    <table class="grid" style="width:330px;margin-left:18px;">
        <tr class="row1">
            <th style="width:180px;">
                Guests Invited
            </th>
            <td class="cn">
                <?php echo count($guests); ?>
            </td>
        </tr>
        <tr class="row2">
            <th>
                Guests Responded
            </th>
            <td class="cn">
                <?php echo $responded; ?>
            </td>
        </tr>
        <tr class="row1">
            <th>
                Attending
            </th>
            <td class="cn">
                <?php echo $attending; ?>
            </td>
        </tr>
        <tr class="row2">
            <th>
                Not Attending
            </th>
            <td class="cn">
                <?php echo $not_attending; ?>
            </td>
        </tr>
    </table>
    <br/>
</div>

<div style="float:right;text-align:right;">
    <br/><br/>
    <a href="/guests/add">Add Guest</a><br/>
    <a href="/guests/parseupload">Upload Excel File</a><br/>
    <?php echo $html->link('Delete All',array('action'=>'delete_all'),null,'Are you sure?  This will permanently remove all responses.'); ?><br/>
    <?php echo $html->link('Log Out',array('controller'=>'users','action'=>'logout')); ?>
</div>

<table class="grid">
    <tr>
        <th>
            <?php echo $this->Paginator->sort('Name', 'Guest.last_name'); ?>
        </th>
        <th>
            <?php echo $this->Paginator->sort('Responded', 'Guest.responded'); ?>
        </th>
        <th>
            <?php echo $this->Paginator->sort('Attending', 'Guest.attending'); ?>
        </th>
        <th>
        </th>
    </tr>
    <?php
        $lp = '0';
        $m = 0;
        foreach ($guests as $g) {
            if ($lp != $g['Guest']['party_id']) {
                $m++;   
            }
            if ($m%2=='0') {
                $style = 'row1';
            } else {
                $style = 'row2';
            }
    ?>
    <tr class="<?php echo $style; ?>">
        <td>
    
            <?php echo $g['Guest']['full_name']; ?>
        </td>
        <td class="cn">
            <?php
                if ($g['Guest']['responded']=='1') {
                    echo 'Yes';
                } else {
                    echo 'No';
                }
            ?>
        </td>
        <td class="cn">
            <?php
                if ($g['Guest']['responded']=='1') {
                    if ($g['Guest']['attending']=='1') {
                        echo 'Yes';
                    } elseif ($g['Guest']['attending']=='2') {
                        echo 'No';
                    }
                }
            ?>
        </td>
        <td>
            <?php echo $html->link('Edit',array('action'=>'edit/'.$g['Guest']['id'])); ?>
            <?php echo $html->link('Delete',array('action'=>'delete/'.$g['Guest']['id']),null,'Are you sure you want to delete this person?'); ?>
        </td>
    </tr>
    <?php
    $lp = $g['Guest']['party_id'];
    } ?>
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