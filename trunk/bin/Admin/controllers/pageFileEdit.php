<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_pageFileEdit_controller($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        if(count($SUB_URL) == 2 && $SUB_URL[1] == 'edit') {

            if( isset($_POST[$APP_ID . '_save']) && $_POST[$APP_ID . '_save'] == 'Save' ) {
                $fileContents = $_POST[$APP_ID . '_file_contents'];
                $fileName = WPATH . 'etc' . DS . 'pages' . DS . $SUB_URL[0];
                file_write($fileName, $fileContents);
            }
        }
    }
?>