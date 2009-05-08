<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function User_login_controller($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        if(isset($_POST[$APP_ID . '_login']) && $_POST[$APP_ID . '_login'] == 'Log-in') {
            if(!user_authenticate($_POST[$APP_ID . '_username'], $_POST[$APP_ID . '_password'])) {
                global $ERR_MSG;
                $ERR_MSG = 'Invalid Username or Password!';
            }
        }
        else if(isset($_POST[$APP_ID . '_logout']) && $_POST[$APP_ID . '_logout'] == 'Logout') {
            user_logout();
        }
    }

?>