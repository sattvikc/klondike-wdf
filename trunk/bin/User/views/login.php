<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function User_login_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        content_start();
        content_echo( $subregions['title'], form_start('login'));
        
        content_echo( $subregions['text'], "<h2>Login</h2>\n");
        if(!isset($_SESSION['authenticated_user'])) {
            content_echo( $subregions['text'], "<b>Username</b><br />\n");
            content_echo( $subregions['text'], form_text($APP_ID . '_username', '', 'text', 22));
            content_echo( $subregions['text'], "<br /><b>Password</b><br />\n");
            content_echo( $subregions['text'], form_password($APP_ID . '_password', '', 'text', 22));
            content_echo( $subregions['text'], "<br />\n");
            content_echo( $subregions['text'], form_link_button($APP_ID . '_login', "Log-in", 'login'));
            global $ERR_MSG;
            if(isset($ERR_MSG)) {
                content_echo( $subregions['text'], "<br /><span style=\"color: red;\">$ERR_MSG </span>\n");
            }
        }
        else {
            content_echo( $subregions['text'], "Welcome $_SESSION[authenticated_user], ");
            content_echo( $subregions['text'], form_link_button($APP_ID . '_logout', "Logout", 'login'));
        }
        content_echo( $subregions['text'], form_end());
        content_end();
    }
    
?>