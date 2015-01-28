<h1><?php echo __('User Management > Create New User'); ?></h1>

<fieldset>
    <?php 
    echo $this->Form->create('User', array('type' => 'file'));
    ?>
    <table class="TableView">
        <tr>
            <td><?php echo __('Login'); ?></td>
            <td><?php echo $this->Form->input('login', array('label'=>FALSE, 'div'=>FALSE, 'required')); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Password'); ?></td>
            <td><?php echo $this->Form->input('password', array('label'=>FALSE, 'div'=>FALSE, 'id'=>'pass_1', 'required')); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Confirm Password'); ?></td>
            <td><?php echo $this->Form->input('confime_password', array('label'=>FALSE, 'div'=>FALSE, 'type'=>'password', 'id'=>'pass_2', 'required')); ?></td>
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
            <td><?php echo $this->Form->input('email', array('label'=>FALSE, 'div'=>FALSE)); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Profile Picture'); ?></td>
            <td><?php echo $this->Form->input('pic', array('type'=>'file', 'label'=>FALSE, 'div'=>FALSE)); ?></td>
        </tr>
    </table>
<?php echo $this->Form->submit(__('Save'), array('class'=>'ButtonSave', 'onclick'=>'return check_password();')); ?>
</fieldset>
<?php echo $this->Html->link(__('Back'), array('controller' => 'Users', 'action' => 'Index'), array('class'=>'ButtonLinkBack')); ?>



<script>
    function check_password(){
        if(document.getElementById('pass_1').value === '' || document.getElementById('pass_2').value === ''){
            alert("Password cannot empty");
            return false;
        }
        if(document.getElementById('pass_1').value !== document.getElementById('pass_2').value){
            alert("Password not match");
            return false;
        }
    }
</script>