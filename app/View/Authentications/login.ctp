<?php echo $this->Form->create(array("div"=>FALSE, "id"=>"login")); ?>
<h1>Login</h1>

<fieldset id="inputs">
    <?php echo $this->Form->input( "username", array("id" => "username", "label" => FALSE, "type" => "text", "placeholder" => "Username", "autofocus", "required", "div" => FALSE)); ?>
    <?php echo $this->Form->input( "password", array("id" => "password", "label" => FALSE, "type" => "password", "placeholder" => "Password", "required", "div" => FALSE)); ?>
</fieldset>
    <?php echo $this->Form->input('auto_login', array("id" => "auto_login", 'type' => 'checkbox', 'value'=>'Y', 'label' => __('Keep me logged in', true))); ?>    
<fieldset id="actions">
    <?php echo $this->Form->submit("Login", array("div"=>FALSE, "value"=>"Log in", "id"=>"submit")); ?>
    <?php if(isset($msg)){ ?>
    <a style="color: red;font-size: 12px;text-align: left;"><?=$msg?></a>
    <?php } ?>
</fieldset>

