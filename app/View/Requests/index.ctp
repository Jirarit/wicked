<h1><?php echo __('Request Orders'); ?></h1>
<fieldset>
    <?php 
    echo $this->Form->create('Request',array('url'=>"/Requests/index/page:1"));
    echo __('Status');
    echo "&nbsp; &nbsp;";
    echo $this->Form->input('status' , array('type'=>'radio', 'options'=>array("N"=>"New" , "R" => "Received"), 'default'=>'N', 'legend'=>FALSE, 'div'=>FALSE, 'required'));
    echo "<br>";
    echo __('Request Date');
    echo "&nbsp; &nbsp;";
    echo $this->Form->input('from_date' , array('div'=>FALSE, 'label'=>FALSE, 'type'=>'text', 'class'=>'datepicker','style'=>'margin-top:20px;'));
    echo "&nbsp;To&nbsp;";
    echo $this->Form->input('to_date' , array('div'=>FALSE, 'label'=>FALSE, 'type'=>'text', 'class'=>'datepicker'));
    echo "&nbsp;";
    echo $this->Form->submit('Search', array('div'=>FALSE, 'class'=>'ButtonSearch'));
    ?>
</fieldset>
<?php
echo $this->Html->link(__('Create New Request'), array('controller' => 'Requests', 'action' => 'add'), array('class'=>'ButtonLinkAdd', 'div'=>FALSE));
?>
<br><br>
<?php 
    $current_page = $this->Paginator->counter(array('format' => __('{:pages}'))); 
    $start_rec = $this->Paginator->counter(array('format' => __('{:start}')));
?>
<table class="TableIndex" style="width: 90%;white-space:nowrap;">
    <tr>
        <th class="index">#</th>
        <th class="datetime"><?php echo $this->Paginator->sort('request_date'); ?></th>
        <th><?php echo $this->Paginator->sort('status'); ?></th>
        <th class="datetime"><?php echo $this->Paginator->sort('receive_date'); ?></th>
        <th class="datetime"><?php echo $this->Paginator->sort('created', 'Create Date'); ?></th>
        <th class="datetime"><?php echo $this->Paginator->sort('modified', 'Update Date'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php 
    if(!empty($requests)){
    foreach ($requests as $k => $request):
    ?>
	<tr>
            <td class="index"><?php echo $start_rec++; ?></td>
            <td class="datetime"><?php echo h($request['Request']['request_date']); ?>&nbsp;</td>
            <td style="text-align: center;"><?php echo h($request['Request']['status'] === 'N' ? "New" : "Received"); ?>&nbsp;</td>
            <td class="datetime"><?php echo h($request['Request']['receive_date']); ?>&nbsp;</td>
            <td class="datetime"><?php echo h($request['Request']['created']); ?>&nbsp;</td>
            <td class="datetime"><?php echo h($request['Request']['modified']); ?>&nbsp;</td>
            <td class="actions"  style="padding-left: 30px; padding-right: 30px">
                <?php
                echo $this->Html->link(__('View'), array('action' => 'view', $request['Request']['id']), array('class'=>'ButtonLinkDetail'));
                if($request['Request']['status'] === 'N'){
                    echo "&nbsp;";
                    echo $this->Html->link(__('Receive'), array('action' => 'receive', $request['Request']['id']), array('class'=>'ButtonLinkBack'));
                    echo "&nbsp;";
                    echo $this->Html->link(__('Delete'), array('action' => 'delete', $request['Request']['id']), array('class'=>'ButtonLinkDelete'), __('Are you sure you want to delete?'));
                }
                ?>
            </td>
	</tr>
    <?php 
    endforeach; 
    }else{
        echo $this->Display->empty_table_data();
    }
    ?>
</table>

<p>
<?php
$this->Paginator->options(array('url' => $this->passedArgs));

echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>	
</p>
<?php if($current_page > '1'){ ?>
<div class="paging">
<?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
<?php } ?>