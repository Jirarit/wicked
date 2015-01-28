<?php

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
        <?php echo $this->Html->css('default/style'); ?>
</head>
<body>
    <table class="body_layout" cellspacing="0px">
        <tr>
            <td colspan="2" class="header">
                
                <div class="profile_info">
                    <span style="font-weight: bold">Name : </span><?= $_SESSION['User']['full_name']; ?>
                    <br>
                    <span style="font-weight: bold">Position : </span><?= $_SESSION['User']['position_name']; ?>
                </div>
                <div class="profile_img" style="text-align: center;">
                    <?php 
                    if(file_exists(WEBROOT_DIR . "/img/user/" . @$_SESSION['User']['id'] . ".png")){
                        $img_path = 'user/' . @$_SESSION['User']['id'] . '.png';
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
                    <ul>
                       <li class='title'><a href='#'><span>Menu</span></a></li>
                       <li><a href='Requests/index'><span>Request Order</span></a></li>
                       <li><a href='Receives/index'><span>Receiving</span></a></li>
                       <li><a href='Products/index'><span>Products</span></a></li>
                       <li><a href='Users/index'><span>User Management</span></a></li>
                       <li class='last'><a href='Authentications/logout'><span>Logout</span></a></li>
                    </ul>
                </div>
            </td>
            <td class="content">
                <?php echo $this->fetch('content'); ?>
            </td>
        </tr>
    </table>
    <footer>Copyright © 2014 TaPoneSoft. All Rights Reserved</footer>
</body>

</html>