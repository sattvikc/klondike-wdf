<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function Comments_display_view($params, $subregions) {
        global $CUR_THEME, $_CUR_REGION, $_SETTINGS;
        
        $comments = Comments_get_all( $params['target'], $params['targetType'] );
        
        if( count($comments) == 0) {
            echo "No comments to display!";
            return;
        }
        
        foreach( $comments as $comment) {
            content_start();
            if(isset($comment['username']) && $comment['username'] != '') {
                content_echo($subregions['title'], $comment['username']);
            }
            else {
                content_echo($subregions['title'], $comment['name']);
            }
            content_echo($subregions['datetime'], $comment['commentedOn']);
            content_echo($subregions['text'], $comment['comment']);
            content_end();
        }
    }
    
    function Comments_new_view($params, $subregions) {
        global $CUR_THEME, $_CUR_REGION, $_SETTINGS, $APP_ID;
        
        content_start();
        content_echo($subregions['title'], "Your response");
        content_echo($subregions['datetime'], "");
        content_echo($subregions['text'], form_start($APP_ID . '_newComment'));
        content_echo($subregions['text'], "Name: ");
        content_echo($subregions['text'], form_text($APP_ID . '_name', ''));
        content_echo($subregions['text'], "<br />\n");
        content_echo($subregions['text'], "Comment:<br />");
        content_echo($subregions['text'], form_textarea($APP_ID . '_comment', '', '', '80', '6'));
        content_echo($subregions['text'], "<br />");
        content_echo($subregions['text'], form_button($APP_ID . '_submit', 'Submit'));
        content_echo($subregions['text'], form_end());
        content_end();
    }
?>