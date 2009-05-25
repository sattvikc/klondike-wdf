<div style="display:none;"><img src="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/iblog/'; ?>/images/agradient-30medium.gif" alt="preload" /></div>
    
<div id="page" class="fix">
  <div id="wrapper" class="fix">
    <div id="header" class="fix">
      <h1 class="blogtitle"><a href="<?php echo WURL; ?>"><?php echo join(' ', $_SETTINGS['basic']['title']); ?></a></h1>
      <div class="description">Description</div>
    </div><!-- /header -->

    <div id="nav" class="fix">
        <ul class="fix">
            <li class="page_item current_page_item"><a class="home" href="<?php echo WURL; ?>" title="Home"><img src="<?php echo $_SETTINGS['basic']['url'] .  'share/themes/iblog/'; ?>images/home-icon-trans.png" alt="home"/></a></li>
<?php region_theme_load("menu"); ?>
        </ul>
    </div><!-- /nav -->

    <div id="container" class="fix">
      <div id="left-col">
        <div id="content">
<?php region_theme_load("content"); ?>
    <ol class="commentlist">
<?php region_theme_load("comment"); ?>
    </ol>

          <div class="page-nav fix"></div><!-- page nav -->
        </div>
      </div>
      <div class="dbx-group" id="sidebar">
<?php region_theme_load("right"); ?>
      </div><!--/sidebar -->
    </div>
  <div id="cred"><div class="designer fix"><?php region_theme_load("bottom"); ?></div></div>
  <hr class="hidden" />

  </div><!--/wrapper -->
</div><!--/page -->

<!-- Analytics Go Here -->

<!-- End Analytics -->