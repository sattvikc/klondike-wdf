<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function User_createUser_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        content_start();
        content_echo($subregions['title'], 'Create User');
        content_echo($subregions['text'], form_start('create_user'));
        content_echo($subregions['text'], "<table>\n");
        
        content_echo($subregions['text'], "<tr>\n");
        content_echo($subregions['text'], "<td>Name</td>\n");
        content_echo($subregions['text'], "<td>");
        content_echo($subregions['text'], form_text($APP_ID . '_name', '', 'text', 22));
        content_echo($subregions['text'], "</td>\n</tr>\n");
        
        content_echo($subregions['text'], "<tr>\n");
        content_echo($subregions['text'], "<td>Username</td>\n");
        content_echo($subregions['text'], "<td>");
        content_echo($subregions['text'], form_text($APP_ID . '_username', '', 'text', 22));
        content_echo($subregions['text'], "</td>\n</tr>\n");
        
        content_echo($subregions['text'], "<tr>\n");
        content_echo($subregions['text'], "<td>Password</td>\n");
        content_echo($subregions['text'], "<td>");
        content_echo($subregions['text'], form_password($APP_ID . '_password', '', 'text', 22));
        content_echo($subregions['text'], "</td>\n</tr>\n");
        
        content_echo($subregions['text'], "<tr>\n");
        content_echo($subregions['text'], "<td>Password (again)</td>\n");
        content_echo($subregions['text'], "<td>");
        content_echo($subregions['text'], form_password($APP_ID . '_password2', '', 'text', 22));
        content_echo($subregions['text'], "</td>\n</tr>\n");
        
        content_echo($subregions['text'], "</table>\n");
        content_echo($subregions['text'], form_link_button($APP_ID . '_createUser', "Create", 'create_user'));
        content_echo($subregions['text'], form_end());
        
        content_end();
    }

?>