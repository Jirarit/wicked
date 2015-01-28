<h1><?php echo __('Product Categories > Information'); ?></h1>
<?php echo $this->Html->link(__('Back'), array('controller' => 'ProductCategories', 'action' => 'Index'), array('class'=>'ButtonLinkBack')); ?>
<br><br>
<fieldset>
    <table class="TableView">
        <tr>
            <td><?php echo __('Name'); ?></td><td><?php echo h($productCategory['ProductCategory']['name']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Status'); ?></td><td><?php echo h($productCategory['ProductCategory']['status']=="A" ? "Active" : "Inactive"); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Created'); ?></td><td><?php echo h($productCategory['ProductCategory']['created']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Modified'); ?></td><td><?php echo h($productCategory['ProductCategory']['modified']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Create By'); ?></td><td><?php echo h($create_uname); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Update By'); ?></td><td><?php echo h($update_uname); ?></td>
        </tr>
    </table>
</fieldset>

<fieldset>
    <?php 
    echo $this->Form->create('ProductSubCategory', array('url'=>array('controller'=>'ProductCategories' , 'action'=>'add_sub_category' , $productCategory['ProductCategory']['id']))); 
    echo $this->Form->hidden('product_category_id' , array('value' => $productCategory['ProductCategory']['id']));
    echo __('Sub Category') . " : " . $this->Form->input('name', array('label'=>FALSE, 'div'=>FALSE));
    echo "&nbsp;&nbsp;" . $this->Form->submit(__('Add'), array('class'=>'ButtonSave', 'div'=>false));
    ?>
    <hr>
    <table class="TableIndex" style="width: 50%;">
    <tr>
        <th class="index">#</th>
        <th><?php echo __('Name'); ?></th>
        <th class="datetime"><?php echo __('Modified'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php 
    if(!empty($productSubCategories)){
    foreach ($productSubCategories as $k => $productSubCategory): ?>
	<tr>
            <td class="index"><?php echo $k+1; ?></td>
            <td><?php echo h($productSubCategory['ProductSubCategory']['name']); ?>&nbsp;</td>
            <td class="datetime"><?php echo h($productSubCategory['ProductSubCategory']['modified']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view_sub_category', $productSubCategory['ProductSubCategory']['id'], $productCategory['ProductCategory']['id']), array('class'=>'ButtonLinkDetail')); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit_sub_category', $productSubCategory['ProductSubCategory']['id'], $productCategory['ProductCategory']['id']), array('class'=>'ButtonLinkEdit')); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete_sub_category', $productSubCategory['ProductSubCategory']['id'], $productCategory['ProductCategory']['id']), array('class'=>'ButtonLinkDelete'), __('Are you sure you want to delete %s?', $productSubCategory['ProductSubCategory']['name'])); ?>
            </td>
	</tr>
    <?php 
    endforeach; 
    }else{
        echo $this->Display->empty_table_data();
    }
    ?>
</table>
</fieldset>