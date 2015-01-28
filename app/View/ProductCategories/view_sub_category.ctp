<h1><?php echo __('Product Categories') . ' > ' . $product_category; ?></h1>
<fieldset>
    <table class="TableView">
        <tr>
            <td><?php echo __('Name'); ?></td><td><?php echo h($productSubCategory['ProductSubCategory']['name']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Status'); ?></td><td><?php echo h($productSubCategory['ProductSubCategory']['status']=="A" ? "Active" : "Inactive"); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Created'); ?></td><td><?php echo h($productSubCategory['ProductSubCategory']['created']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Modified'); ?></td><td><?php echo h($productSubCategory['ProductSubCategory']['modified']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Create By'); ?></td><td><?php echo h($create_uname); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Update By'); ?></td><td><?php echo h($update_uname); ?></td>
        </tr>
    </table>
</fieldset>
<?php echo $this->Html->link(__('Back'), array('controller' => 'ProductCategories', 'action' => 'view', $productSubCategory['ProductSubCategory']['product_category_id']), array('class'=>'ButtonLinkBack')); ?>
