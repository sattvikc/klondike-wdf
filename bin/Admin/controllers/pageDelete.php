<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_pageDelete_controller($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        if( isset($_POST[$APP_ID . '_yes']) && $_POST[$APP_ID . '_yes'] == 'Yes' ) {
            if ( count($SUB_URL) == 2 && $SUB_URL[1] == 'delete') {
                unlink ( WPATH . 'etc' . DS . 'pages' . DS . $SUB_URL[0] );
                echo "<script>window.location = '" . url_generate("admin/pages") . "'</script>";
            }
        }
        else if( isset($_POST[$APP_ID . '_no']) && $_POST[$APP_ID . '_no'] == 'No' ) {
            echo "<script>window.location = '" . url_generate("admin/pages") . "'</script>";
        }
    }
?>