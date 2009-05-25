<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function PrimeGenerate_default_view($parameters, $subregions) {
        global $_CUR_REGION, $_SETTINGS;
        
        content_start();
        content_echo( $subregions['title'], 'Prime number Generation');
        content_echo( $subregions['text'], '2');
        for($i=3; $i < 5000; $i++) {
            if(PrimeGenerate_isPrime($i)) content_echo( $subregions['text'], ', ' . $i);
        }
        content_end();
    }
?>