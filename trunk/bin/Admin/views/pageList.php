<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_pageList_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        $pages = dir_get_files(WPATH . 'etc' . DS . 'pages');
        foreach($pages as $page) {
            echo '<a href="' . url_generate('admin/pages/' . $page). '">';
            echo $page;
            echo "</a>\n";
        }
        
        if(count($SUB_URL) == 1) {
            echo "<textarea>\n";
            echo file_read(WPATH . 'etc' . DS . 'pages' . DS . $SUB_URL[0]);
            echo "</textarea>\n";
        }
    }
?>