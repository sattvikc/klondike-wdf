<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<?php Sys::LoadHead(); ?>
<link rel="stylesheet" href="<?php echo WURL; ?>share/jquery/css/dark-hive/style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/colourise/style.css'; ?>" type="text/css" />
</head>
<body>
<div id="wrap">
    <div id="header">
        <h1 id="logo-text"><a href="<?php echo WURL; ?>"><?php echo join(' ', $_SETTINGS['basic']['title']); ?></a></h1>        
        <p id="intro">
        <?php echo $_SETTINGS['basic']['tagline']; ?>
        </p>    
        
        <div  id="nav">
            <ul>
<?php Region::Load("menu"); ?>
            </ul>
        </div>
        
    <!--header ends-->
    </div>
    
    <!-- content-wrap starts -->
    <div id="content-wrap">
        <div id="main">
<?php Region::Load("content"); ?>
<?php Region::Load("comment"); ?>
        <!-- main ends -->    
        </div>
        <!-- sidebar starts -->
        <div id="sidebar">
<?php Region::Load("right"); ?>
        <!-- sidebar ends -->
        </div>        
    <!-- content-wrap ends-->    
    </div>
        
    <!-- footer starts here -->    
    <div id="footer-wrap"><div id="footer-content">
    
        <div class="col float-left space-sep">
<?php Region::Load("user1"); ?>
        </div>
        
        <div class="col float-left">
<?php Region::Load("user2"); ?>
        </div>        
    
        <div class="col2 float-right">
<?php Region::Load("user3"); ?>
        </div>
        
    </div></div>
    <div class="clearer"></div>
    <!-- footer ends here -->
<!-- wrap ends here -->
</div>
</body>
</html>