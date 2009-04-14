<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <link rel="stylesheet" href="<?php echo WURL; ?>sys/admin/style.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo WURL; ?>var/resources/Admin/css/smoothness.css" type="text/css" />
        <script type="text/javascript" src="<?php echo WURL; ?>/lib/js/jquery.js"></script> 
        <script type="text/javascript" src="<?php echo WURL; ?>/lib/js/jquery-ui.js"></script> 
    </head>
    <body>
        <div id="container">
            <div id="title">
                Dashboard
            </div>
            <div id="main">
                <div id="top">
                    <a href="<?php echo url_generate('admin'); ?>">Home</a>
<?php
    $adminUrl = 'admin';
    for($i=2; $i<count($URL_PATH); $i++) {
    $adminUrl .= '/' . $URL_PATH[$i];
        echo '&gt; <a href="' . url_generate($adminUrl) . '">' . $URL_PATH[$i] . '</a>';
    }
?>
                </div>
                <div id="content">
                    <div id="left">
<?php region_theme_load('left'); ?>
                    </div>
                    <div id="right">
<?php region_theme_load('content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
