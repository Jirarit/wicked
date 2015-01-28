<h1><?php echo __('User Management > Edit'); ?></h1>

<fieldset>
    <?php 
    echo $this->Form->create('User', array('type' => 'file')); 
    echo $this->Form->input('id');
    ?>
    <table class="TableView">
        <tr>
            <td><?php echo __('Login'); ?></td>
            <td><?php echo $this->Form->input('login', array('label'=>FALSE, 'div'=>FALSE, 'required')); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Full Name'); ?></td>
            <td><?php echo $this->Form->input('full_name', array('label'=>FALSE, 'div'=>FALSE, 'required')); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Nick Name'); ?></td>
            <td><?php echo $this->Form->input('nick_name', array('label'=>FALSE, 'div'=>FALSE, 'required')); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Position'); ?></td>
            <td><?php echo $this->Form->input('position' , array('type'=>'radio', 'options'=>["A"=>"Admin" , "S" => "Staff"], 'legend'=>FALSE, 'required'));?></td>
        </tr>
        <tr>
            <td><?php echo __('Email'); ?></td>
            <td><?php echo $this->Form->input('email', array('label'=>FALSE, 'div'=>FALSE, 'required')); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Profile Picture'); ?></td>
            <td><?php echo $this->Form->input('pic', array('type'=>'file', 'label'=>FALSE, 'div'=>FALSE)); ?></td>
        </tr>
    </table>
<?php echo $this->Form->submit(__('Save'), array('class'=>'ButtonSave')); ?>
</fieldset>
<?php echo $this->Html->link(__('Back'), array('controller' => 'Users', 'action' => 'Index'), array('class'=>'ButtonLinkBack')); ?>
