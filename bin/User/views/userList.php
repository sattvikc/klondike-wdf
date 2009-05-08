<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function User_userList_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        $pages = db_fetch_all("SELECT username FROM " . $_SETTINGS['database']['prefix'] . "users;");
        sort($pages);
        form_start('newPage');
        echo "<table class=\"datatable\">\n";
        foreach($pages as $page) {
            $page = $page['username'];
            if($page == 'admin') continue;
            echo "<tr>\n";
            
            echo '<td>';
            echo $page;
            echo "</td>\n";
            
            echo '<td><a href="' . url_generate('admin/users/' . $page . '/delete'). '">';
            echo "delete";
            echo "</a></td>\n";
            
            echo "</tr>\n";
            
        }
    }

?>