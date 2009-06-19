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
