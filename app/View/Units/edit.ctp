<h1><?php echo __('Product Units > Edit'); ?></h1>

<fieldset>
    <?php 
    echo $this->Form->create('Unit');
    echo $this->Form->input('id');
    echo __('Name') . " : " . $this->Form->input('name', array('label'=>FALSE, 'div'=>FALSE));
    echo "&nbsp;&nbsp;" . $this->Form->submit(__('Save'), array('class'=>'ButtonSave', 'div'=>false));
    ?>
</fieldset>
<?php echo $this->Html->link(__('Back'), array('controller' => 'Units', 'action' => 'Index'), array('class'=>'ButtonLinkBack')); ?>
