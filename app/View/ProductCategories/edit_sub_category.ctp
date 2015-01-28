<h1><?php echo __('Product Categories > ' . $product_category . ' > Sub Category > Edit'); ?></h1>

<fieldset>
    <?php 
    echo $this->Form->create('ProductSubCategory', array('url'=>array('controller'=>'ProductCategories' , 'action'=>'edit_sub_category' , $this->request->data['ProductSubCategory']['id'],$this->request->data['ProductSubCategory']['product_category_id']))); 
    echo $this->Form->input('id');
    echo __('Name') . " : " . $this->Form->input('name', array('label'=>FALSE, 'div'=>FALSE));
    echo "&nbsp;&nbsp;" . $this->Form->submit(__('Save'), array('class'=>'ButtonSave', 'div'=>false));
    ?>
</fieldset>
<?php echo $this->Html->link(__('Back'), array('controller' => 'ProductCategories', 'action' => 'view', $this->request->data['ProductSubCategory']['product_category_id']), array('class'=>'ButtonLinkBack')); ?>
