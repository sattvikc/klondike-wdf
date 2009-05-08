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
    
    function User_createUser_controller($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        if(isset($_POST[$APP_ID . '_createUser']) && $_POST[$APP_ID . '_createUser'] == 'Create') {
            if($_POST[$APP_ID . '_password'] != $_POST[$APP_ID . '_password2']) {
                global $ERR_MSG;
                $ERR_MSG = 'Invalid Username or Password!';
                return;
            }
            user_create($_POST[$APP_ID . '_username'], $_POST[$APP_ID . '_password2']);
        }
    }
    
    function User_userDelete_controller($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        if( isset($_POST[$APP_ID . '_yes']) && $_POST[$APP_ID . '_yes'] == 'Yes' ) {
            if ( count($SUB_URL) == 2 && $SUB_URL[1] == 'delete') {
                user_delete($SUB_URL[0]);
            }
            echo "<script>window.location = '" . url_generate("admin/users") . "'</script>";
        }
    }

?>