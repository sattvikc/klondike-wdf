<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function PrimeGenerate_default_view($parameters, $subregions) {
        global $_CUR_REGION, $_SETTINGS;
        
        $content = array();
        $content['title'] = 'Prime number Generation';
        $content['text'] = '2';
        for($i=3; $i < 5000; $i++) {
            if(PrimeGenerate_isPrime($i)) $content['text'] .= ', ' . $i;
        }
        include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . $_CUR_REGION . '.php';
    }
?>