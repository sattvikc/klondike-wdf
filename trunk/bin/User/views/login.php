<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function User_login_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        form_start('login');
        echo "<h2>Login</h2>\n";
        if(!isset($_SESSION['authenticated_user'])) {
            echo "<b>Username</b><br />\n";
            form_text($APP_ID . '_username', '', 'text', 22);
            echo "<br /><b>Password</b><br />\n";
            form_password($APP_ID . '_password', '', 'text', 22);
            echo "<br />\n";
            form_link_button($APP_ID . '_login', "Log-in", 'login');
            global $ERR_MSG;
            if(isset($ERR_MSG)) {
                echo "<br /><span style=\"color: red;\">$ERR_MSG </span>\n";
            }
        }
        else {
            echo "Welcome $_SESSION[authenticated_user], ";
            form_link_button($APP_ID . '_logout', "Logout", 'login');
        }
        form_end();
    }

?>