<h1><?php echo __('Products > Information'); ?></h1>
<fieldset>
    <table class="TableView">
        <tr>
            <td><?php echo __('Product No'); ?></td><td><?php echo h($product['Product']['product_no']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Name'); ?></td><td><?php echo h($product['Product']['product_name']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Category'); ?></td><td><?php echo h($category); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Sub Category'); ?></td><td><?php echo h($sub_category); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Unit'); ?></td><td><?php echo h($unit); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Par Stock'); ?></td><td><?php echo h($product['Product']['par_stock']) ?></td>
        </tr>
        <tr>
            <td><?php echo __('Status'); ?></td><td><?php echo h($product['Product']['status']=="A" ? "Active" : "Inactive"); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Created'); ?></td><td><?php echo h($product['Product']['created']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Modified'); ?></td><td><?php echo h($product['Product']['modified']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Create By'); ?></td><td><?php echo h($create_uname); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Update By'); ?></td><td><?php echo h($update_uname); ?></td>
        </tr>
    </table>
</fieldset>
<?php echo $this->Html->link(__('Back'), array('controller' => 'Products', 'action' => 'Index'), array('class'=>'ButtonLinkBack')); ?>
