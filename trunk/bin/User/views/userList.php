<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function User_userList_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        $users = db_fetch_all("SELECT username FROM " . $_SETTINGS['database']['prefix'] . "users;");
        sort($users);
        form_start('newPage');
        echo "<table class=\"datatable\">\n";
        foreach($users as $user) {
            $user = $user['username'];
            if($user == 'admin') continue;
            echo "<tr>\n";
            
            echo '<td>';
            echo $user;
            echo "</td>\n";
            
            echo '<td><a href="' . url_generate('admin/users/' . $user . '/delete'). '">';
            echo "delete";
            echo "</a></td>\n";
            
            echo "</tr>\n";
            
        }
    }

?>