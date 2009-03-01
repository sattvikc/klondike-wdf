<?php

    function CustomHtml_default_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS;
        $content = array();
        $content[ $subregions['title'] ] = $params['title'];
        $content[ $subregions['text'] ] = $params['text'];
        include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . $_CUR_REGION . '.php';
    }
    
?>