<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_pageShowYaml_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        $page = WPATH . 'etc' . DS . 'pages' . DS . $SUB_URL[0];
        
        echo "<pre>\n";
        echo file_read($page);
        echo "</pre>\n";
    }
?>