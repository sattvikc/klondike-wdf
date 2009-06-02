<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
<?php Sys::LoadHead(); ?>
        <link rel="stylesheet" href="<?php echo WURL; ?>share/themes/admin/style.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo WURL; ?>var/resources/Admin/css/cupertino.css" type="text/css" />
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
    global $URL_PATH;
    for($i=2; $i<count($URL_PATH); $i++) {
    $adminUrl .= '/' . $URL_PATH[$i];
        echo '&gt; <a href="' . url_generate($adminUrl) . '">' . $URL_PATH[$i] . '</a>';
    }
?>
                </div>
                <div id="maincontent">
                    <div id="left">
<?php Region::Load('left'); ?>
                    </div>
                    <div id="sright">
<?php Region::Load('content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
