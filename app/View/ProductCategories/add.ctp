<h1><?php echo __('Product Categories > Create New Category'); ?></h1>

<fieldset>
    <?php 
    echo $this->Form->create('ProductCategory');
    echo __('Name') . " : " . $this->Form->input('name', array('label'=>FALSE, 'div'=>FALSE));
    echo "&nbsp;&nbsp;" . $this->Form->submit(__('Save'), array('class'=>'ButtonSave', 'div'=>false));
    ?>
</fieldset>
<?php echo $this->Html->link(__('Back'), array('controller' => 'ProductCategories', 'action' => 'Index'), array('class'=>'ButtonLinkBack')); ?>
