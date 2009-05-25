<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function CustomHtml_default_view($params, $subregions) {
        global $CUR_THEME, $_CUR_REGION, $_SETTINGS;
        //$content = array();
        content_start();
        
        content_echo($subregions['title'], $params['title']);
        content_echo($subregions['text'], $params['text']);

        content_end();
        
        //include WPATH . 'share' . DS . 'themes' . DS . $CUR_THEME . DS . $_CUR_REGION . '.php';
    }
?>