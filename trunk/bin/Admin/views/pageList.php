<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_pageList_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        $pages = dir_get_files(WPATH . 'etc' . DS . 'pages');
        sort($pages);
        form_start('newPage');
        echo "<table class=\"datatable\">\n";
        foreach($pages as $page) {
            echo "<tr>\n";
            
            echo '<td><a href="' . url_generate('admin/pages/' . $page). '">';
            echo $page;
            echo "</a></td>\n";
            
            echo '<td><a href="' . url_generate('admin/pages/' . $page . '/edit'). '">';
            echo "edit";
            echo "</a></td>\n";
            
            echo '<td><a href="' . url_generate('admin/pages/' . $page . '/delete'). '">';
            echo "delete";
            echo "</a></td>\n";
            
            echo "</tr>\n";
            
        }
        
        echo "<tr>\n";
        
        echo '<td>';
        form_text($APP_ID . '_pageName', 'newpage.yaml', 'text', 50);
        echo "</td>\n";
        
        echo '<td colspan="2">';
        form_link_button($APP_ID . '_page_create', 'Create', 'newPage');
        echo "</td>\n";
        
        echo "</tr>\n";
        
        echo "</table>\n";
        form_end();
    }
?>