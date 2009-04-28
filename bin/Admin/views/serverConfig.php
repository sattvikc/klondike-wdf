<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_serverConfig_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        echo "<h2>Server Configuration</h2>\n";
        
        echo "<table class=\"datatable\">\n";
        
        echo "<tr>\n";
        echo "<th>Operating System</th>\n";
        echo "<td>" . PHP_OS . "</td>\n";
        echo "</tr>\n";
        
        echo "<tr>\n";
        echo "<th>PHP Version</th>\n";
        echo "<td>" . phpversion() . "</td>\n";
        echo "</tr>\n";
        
        echo "<tr>\n";
        echo "<th>Software</th>\n";
        echo "<td>" . $_SERVER['SERVER_SOFTWARE'] . "</td>\n";
        echo "</tr>\n";
        
        echo "<tr>\n";
        echo "<th>Name</th>\n";
        echo "<td>" . $_SERVER['SERVER_NAME'] . "</td>\n";
        echo "</tr>\n";

        echo "<tr>\n";
        echo "<th>Address</th>\n";
        echo "<td>" . $_SERVER['SERVER_ADDR'] . "</td>\n";
        echo "</tr>\n";

        echo "<tr>\n";
        echo "<th>Port</th>\n";
        echo "<td>" . $_SERVER['SERVER_PORT'] . "</td>\n";
        echo "</tr>\n";

        echo "<tr>\n";
        echo "<th>URL</th>\n";
        echo "<td>" . WURL . "</td>\n";
        echo "</tr>\n";

        echo "<tr>\n";
        echo "<th>Installation Path</th>\n";
        echo "<td>" . WPATH . "</td>\n";
        echo "</tr>\n";

        echo "</table>\n";
    }
?>
