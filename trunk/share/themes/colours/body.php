        <div id="wrap">
            <div id="header">
               <div id="head">
                   <span id="title"></span>
               </div>
               <div id="logo">
                   <span class="alternate1"><?php echo $_SETTINGS['basic']['title'][0]; ?></span><span class="alternate2"><?php echo $_SETTINGS['basic']['title'][1]; ?></span><br />
                   <span id="tagline"><?php echo $_SETTINGS['basic']['tagline']; ?></span>
               </div>
               <div id="breadcrumbs">
<?php region_theme_load('breadcrumbs'); ?>
               </div>
            </div>
            <div id="body">
                <div id="nav">
                    <ul>
<?php region_theme_load('menu'); ?>
                    </ul>
                </div>
                <div id="maincontent">
<?php region_theme_load('right'); ?>
<?php region_theme_load("content"); ?>
                </div>
            </div>
        </div>
