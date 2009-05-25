<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_pageDelete_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        $pages = dir_get_files(WPATH . 'etc' . DS . 'pages');
        sort($pages);
        echo form_start('deletePage');
        form_link_button($APP_ID . '_yes', 'Yes', 'deletePage');
        echo "<a href=\"" . url_generate("admin/pages") . "\">No</a>";
        echo form_end();
    }
?>