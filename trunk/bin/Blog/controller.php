<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Comments_new_controller($params, $subregions) {
        global $CUR_THEME, $_CUR_REGION, $_SETTINGS, $APP_ID;
        
        if (isset($_POST[$APP_ID . '_submit']) && 'Submit' == $_POST[$APP_ID . '_submit']) {
            Comments_add($params['target'], $params['targetType'], '', $_POST[$APP_ID . '_name'], '', $_POST[$APP_ID . '_comment']);
        }
    }
    
?>