<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_basicSettings_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID;
        
        $editState = state_quick_read("editState") or $editState = "none";
        include WPATH . 'var' . DS . 'resources' . DS . 'Admin' . DS . 'basicSettings.php';
    }
?>