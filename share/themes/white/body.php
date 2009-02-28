        <div id="container">
            <div id="header">
                <div id="logo">
                    <span style="font-size: 2.2em; color: #110;"><?php echo $_SETTINGS['basic']['title'][0]; ?></span>-<span style="font-size: 1.6em; color:#000;"><?php echo $_SETTINGS['basic']['title'][1]; ?></span><br />
                    <span style="font-size: 1em; font-style: italic; color: #222;"><b>WebDev Simplified...</b></span>
                </div>
                <div id="nav">
<?php region_theme_load('menu'); ?>
                </div>
            </div>
            <table cellspacing="0" cellpadding="0" id="main"><tr>
                <td id="col1" class="col">
<?php region_theme_load("left"); ?>
                </td>
                <td id="col2" class="col">
<?php region_theme_load("content"); ?>
                </td>
                <td id="col3" class="col">
<?php region_theme_load("right"); ?>
                </td>
            </tr></table>
        </div>
