<h1><?php echo __('User Management'); ?></h1>

<fieldset>
    <?php 
    echo $this->Form->create('User',array('url'=>"/Users/index/page:1"));
    echo $this->Form->input('search' , array('div'=>FALSE, 'label'=>FALSE));
    echo $this->Form->submit('Search', array('div'=>FALSE, 'class'=>'ButtonSearch'));
    ?>
</fieldset>
<?php echo $this->Html->link(__('Create New User'), array('controller' => 'Users', 'action' => 'add'), array('class'=>'ButtonLinkAdd')); ?>
<br><br>

<?php 
    $current_page = $this->Paginator->counter(array('format' => __('{:pages}'))); 
    $start_rec = $this->Paginator->counter(array('format' => __('{:start}')));
?>
<table class="TableIndex">
    <tr>
        <th class="index">#</th>
        <th><?php echo $this->Paginator->sort('login'); ?></th>
        <th><?php echo $this->Paginator->sort('full_name'); ?></th>
        <th><?php echo $this->Paginator->sort('nick_name'); ?></th>
        <th><?php echo $this->Paginator->sort('position'); ?></th>
        <th><?php echo $this->Paginator->sort('email'); ?></th>
        <th class="datetime"><?php echo $this->Paginator->sort('modified'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php 
    if(!empty($users)){
    foreach ($users as $user): ?>
	<tr>
            <td class="index"><?php echo $start_rec++; ?></td>
            <td><?php echo h($user['User']['login']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['full_name']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['nick_name']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['position']=="A" ? "Admin" : "Staff"); ?>&nbsp;</td>
            <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
            <td class="datetime"><?php echo h($user['User']['modified']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']), array('class'=>'ButtonLinkDetail')); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']), array('class'=>'ButtonLinkEdit')); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('class'=>'ButtonLinkDelete'), __('Are you sure you want to delete %s?', $user['User']['login'])); ?>
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