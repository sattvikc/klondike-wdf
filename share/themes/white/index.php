<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
<?php Sys::LoadHead(); ?>
        <link rel="stylesheet" href="<?php echo WURL; ?>var/resources/Admin/css/cupertino.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/white/'; ?>style.css" type="text/css" />
    </head>
    <body>
        <div id="container">
            <div id="header">
                <div id="logo">
                    <span style="font-size: 2.2em; color: #110;"><?php echo $_SETTINGS['basic']['title'][0]; ?></span>-<span style="font-size: 1.6em; color:#000;"><?php echo $_SETTINGS['basic']['title'][1]; ?></span><br />
                    <span style="font-size: 1em; font-style: italic; color: #222;"><b><?php echo $_SETTINGS['basic']['tagline'] ?></b></span>
                </div>
                <div id="nav">
                    <ul>
<?php Region::Load('menu'); ?>
                    </ul>
                </div>
            </div>
            <table cellspacing="0" cellpadding="0" id="main"><tr>
                <td id="col1" class="col">
<?php Region::Load("left"); ?>
                </td>
                <td id="col2" class="col">
<?php Region::Load("content"); ?>
<?php Region::Load("comment"); ?>
                </td>
                <td id="col3" class="col">
                    <div class="right_wrap">
<?php Region::Load("right"); ?>
                    </div>
                </td>
            </tr></table>
        </div>

    </body>
</html>
