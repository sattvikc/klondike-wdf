<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/iblog/style.css'; ?> ." type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/iblog/print.css'; ?>" type="text/css" media="print" />

<!-- Sidebar docking boxes (dbx) by Brothercake - http://www.brothercake.com/ -->
<script type="text/javascript" src="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/iblog/'; ?>/dbx.js"></script>
<script type="text/javascript" src="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/iblog/'; ?>/dbx-key.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/iblog/'; ?>/dbx.css" media="screen, projection" />

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
<![endif]-->


<!--[if IE 6]>
<script src="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/iblog/'; ?>/belatedpng.js"></script>
<script>
  DD_belatedPNG.fix('.sheen', '#searchform #searchsubmit','.dbx-content ul li');
 </script>
<![endif]-->
</head>
<body>
<div style="display:none;"><img src="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/iblog/'; ?>/images/agradient-30medium.gif" alt="preload" /></div>
    
<div id="page" class="fix">
  <div id="wrapper" class="fix">
    <div id="header" class="fix">
      <h1 class="blogtitle"><a href="<?php echo WURL; ?>"><?php echo join(' ', $_SETTINGS['basic']['title']); ?></a></h1>
      <div class="description"><?php echo $_SETTINGS['basic']['tagline']; ?></div>
    </div><!-- /header -->

    <div id="nav" class="fix">
        <ul class="fix">
            <li class="page_item active"><a class="home" href="<?php echo WURL; ?>" title="Home"><img src="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/iblog/'; ?>images/home-icon-trans.png" alt="home"/></a></li>
<?php Region::Load("menu"); ?>
        </ul>
    </div><!-- /nav -->

    <div id="container" class="fix">
      <div id="left-col">
        <div id="content">
<?php Region::Load("content"); ?>
    <ol class="commentlist">
<?php Region::Load("comment"); ?>
    </ol>

          <div class="page-nav fix"></div><!-- page nav -->
        </div>
      </div>
      <div class="dbx-group" id="sidebar">
<?php Region::Load("right"); ?>
      </div><!--/sidebar -->
    </div>
  <div id="cred"><div class="designer fix"><?php Region::Load("bottom"); ?></div></div>
  <hr class="hidden" />

  </div><!--/wrapper -->
</div><!--/page -->
<!-- Analytics Go Here -->
<!-- End Analytics -->
</body>
</html>