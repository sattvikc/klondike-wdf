<?php

    function Menu_list_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS;
        $menu = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'Menu' . DS . $params['menu'] . '.yaml');
        $content = array();
        foreach($menu['items'] as $item) {
            $content[ $subregions['url'] ] = url_generate($item['url']);
            $content[ $subregions['text'] ] = $item['text'];
            include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . $_CUR_REGION . '.php';
        }
    }
    
?>