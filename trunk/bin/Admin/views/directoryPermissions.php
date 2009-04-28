<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_directoryPermissions_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        $directoriesToCheck = array (
            'bin',
            'etc',
            'sys',
            'var'
        );
        
        $preferredDeveloperSettings = array (true, true, false, true);
        $preferredUserSettings = array (false, true, false, true);
        
        $i = 0;
        
        echo "<h2>Directory Permissions</h2>\n";
        
        echo "<table class=\"datatable\">\n";
        echo "<tr>
<th>Directory</th>
<th>Writeable</th>
<th>Developer</th>
<th>User</th>
</tr>\n";
        foreach ( $directoriesToCheck as $d ) {
            echo "<tr>\n";
            $writeable = is_writeable(WPATH . $d);
            echo "<td>" . $d . "</td>\n";
            if ( $writeable )
                echo "<td class=\"green\">yes</td>\n";
            else
                echo "<td class=\"red\">no</td>\n";
            if($writeable == $preferredDeveloperSettings[$i]) 
                echo "<td class=\"green\">yes</td>\n";
            else
                echo "<td class=\"red\">no</td>\n";

            if($writeable == $preferredUserSettings[$i]) 
                echo "<td class=\"green\">yes</td>\n";
            else
                echo "<td class=\"red\">no</td>\n";

            $i++;
            echo "</tr>\n";
        }
        
        echo "</table>\n";
    }
?>
