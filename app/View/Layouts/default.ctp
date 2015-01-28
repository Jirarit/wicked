<?php

?>
<!DOCTYPE html>
<html>
<head>
    <?php 
    echo $this->Html->charset();
    echo $this->Html->css('default/style');
    echo $this->Html->script('jquery-1.8.3.min.js');
    echo $this->Html->script('datepicker/jquery-ui.min.js');
    echo $this->Html->css('datepicker/jquery-ui');
    ?>    
</head>
<body>
    <table class="body_layout" cellspacing="0px">
        <tr>
            <td colspan="2" class="header">
                
                <div class="profile_info">
                    <span style="font-weight: bold">Name : </span><?= $_SESSION['User']['full_name']; ?>
                    <br>
                    <span style="font-weight: bold">Nickname : </span><?= $_SESSION['User']['nick_name']; ?>
                    <br>
                    <span style="font-weight: bold">Position : </span><?= $_SESSION['User']['position']==="A" ? "Admin" : "Staff"; ?>
                    <br>
                    <a href="/Authentications/logout" class="ButtonLinkBack">Logout</a>
                </div>
                <div class="profile_img" style="text-align: center;">
                    <?php 
                    if(!empty($_SESSION['User']['pic']) && file_exists(WWW_ROOT . "img/user/" . @$_SESSION['User']['pic'])){
                        $img_path = 'user/' . @$_SESSION['User']['pic'];
                        $alt = $_SESSION['User']['full_name'];
                    }else{
                        $img_path = 'user/default.png';
                        $alt = "No pic";
                    }
                    echo $this->Html->image($img_path, array('alt' => $alt));
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class="menus">
                <div id='cssmenu'>
                    <?php 
                        $requestsControllers = array('Requests'); 
                        $receivesControllers = array('Receives'); 
                        $pickupControllers = array('PickUps'); 
                        $destroyControllers = array('Destroy');
                        $reportControllers = array('Reports');
                        $masterControllers = array('MasterDatas', 'Users', 'Products', 'ProductCategories', 'Units'); 
                    ?>
                    <ul>
                       <li class='title'><a><span><?php echo "Today : " . date("D d M Y"); ?></span></a></li>
                       <li class="<?= in_array($this->name, $requestsControllers) ? "active" : "" ?>">
                           <a href='/Requests/index'><span>Request Order</span></a>
                       </li>
                       <li class="<?= in_array($this->name, $pickupControllers) ? "active" : "" ?>">
                           <a href='/PickUps/index'><span>Pick up</span></a>
                       </li>
                       <li class="<?= in_array($this->name, $destroyControllers) ? "active" : "" ?>">
                           <a href='/Destroy/index'><span>Destroy</span></a>
                       </li>
                       <li class="<?= in_array($this->name, $reportControllers) ? "active" : "" ?>">
                           <a href='/Reports/index'><span>Reports</span></a>
                       </li>
                       <?php if($_SESSION['User']['position'] === "A"){ ?>
                       <li class="<?= in_array($this->name, $masterControllers) ? "active" : "" ?>">
                           <a href='/MasterDatas/index'><span>Master Data</span></a>
                       </li>
                       <?php } ?>
                    </ul>
                </div>
            </td>
            <td class="content">
                <?php echo $this->fetch('content'); ?>
            </td>
        </tr>
    </table>
<?php echo $this->element('sql_dump'); ?>
    <footer>Copyright © 2014 TaPoneSoft. All Rights Reserved</footer>
</body>
</html>