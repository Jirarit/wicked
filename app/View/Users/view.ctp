<h1><?php echo __('User Management > Information'); ?></h1>

<fieldset>
    <table class="TableView">
        <tr>
            <td><?php echo __('Login'); ?></td><td><?php echo h($user['User']['login']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Full Name'); ?></td><td><?php echo h($user['User']['full_name']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Nick Name'); ?></td><td><?php echo h($user['User']['nick_name']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Position'); ?></td><td><?php echo h($user['User']['position']=="A" ? "Admin" : "Staff"); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Email'); ?></td><td><?php echo h($user['User']['email']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Created'); ?></td><td><?php echo h($user['User']['created']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Modified'); ?></td><td><?php echo h($user['User']['modified']); ?></td>
        </tr>
    </table>
    <?php echo $this->Html->link(__('Reset Password'), array('controller' => 'Users', 'action' => 'reset_password', $user['User']['id']), array('class'=>'ButtonLinkEdit')); ?>
</fieldset>
<?php echo $this->Html->link(__('Back'), array('controller' => 'Users', 'action' => 'Index'), array('class'=>'ButtonLinkBack')); ?>
