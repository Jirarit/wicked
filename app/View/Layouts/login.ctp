<!DOCTYPE html>
<html>
    <head>
	<?php echo $this->Html->charset(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="TaPoneSoft" />
	<title><?php echo $this->fetch('title'); ?></title>
        
        <?php echo $this->Html->css('login/style'); ?>

    </head>
<body>
    <div id="content">
            <?php echo $this->fetch('content'); ?>
    </div>
</body>
<footer><?php echo "Copyright © 2014 TaPoneSoft. All Rights Reserved"; ?></footer>
</html>