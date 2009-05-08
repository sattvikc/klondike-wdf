<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function User_userDelete_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        $pages = dir_get_files(WPATH . 'etc' . DS . 'pages');
        sort($pages);
        form_start('deleteUser');
        form_link_button($APP_ID . '_yes', 'Yes', 'deleteUser');
        echo "<a href=\"" . url_generate("admin/users") . "\">No</a>";
        form_end();
    }
?>