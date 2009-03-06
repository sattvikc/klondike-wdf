        <div id="wrap">
            <div id="header">
               <div id="logo">
                   <?php echo $_SETTINGS['basic']['title'][0]; ?><span class="alternate"><?php echo $_SETTINGS['basic']['title'][1]; ?></span>
                   <span id="tagline">WebDev Simplified...</span>
               </div>
               <div id="head">
                   <span id="title">Home</span>
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
<?php region_theme_load("content"); ?>
            </div>
        </div>
