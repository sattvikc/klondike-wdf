<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function User_createUser_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        form_start('create_user');
        echo "<h2>Create User</h2>\n";
        echo "<table>\n";

        echo "<tr>\n";
        echo "<td>Username</td>\n";
        echo "<td>";
        form_text($APP_ID . '_username', '', 'text', 22);
        echo "</td>\n</tr>\n";

        echo "<tr>\n";
        echo "<td>Password</td>\n";
        echo "<td>";
        form_password($APP_ID . '_password', '', 'text', 22);
        echo "</td>\n</tr>\n";

        echo "<tr>\n";
        echo "<td>Password (again)</td>\n";
        echo "<td>";
        form_password($APP_ID . '_password2', '', 'text', 22);
        echo "</td>\n</tr>\n";

        echo "</table>\n";
        form_link_button($APP_ID . '_createUser', "Create", 'create_user');
        global $ERR_MSG;
        if(isset($ERR_MSG)) {
            echo "<br /><span style=\"color: red;\">$ERR_MSG </span>\n";
        
        }
        form_end();
    }

?>