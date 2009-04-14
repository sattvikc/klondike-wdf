<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function Menu_list_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $URL_PATH, $MAIN_URL, $SUB_URL;
        $menu = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'Menu' . DS . $params['menu'] . '.yaml');
        
        foreach($menu['items'] as $item) {
            if(isset($content)) unset($content);
            $content = array();
            $content[ $subregions['url'] ] = url_generate($item['url']);
            $content[ $subregions['text'] ] = $item['text'];
            if($item['url'] == $MAIN_URL) $content['class'] = 'active';
            include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . $_CUR_REGION . '.php';
        }
    }
?>