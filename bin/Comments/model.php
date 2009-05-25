<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function Comments_get_all($target, $targetType) {
        global $_SETTINGS;
        $query = "SELECT * FROM " . $_SETTINGS['database']['prefix'] . "comments WHERE target='$target' AND targetType='$targetType';";
        return db_fetch_all($query);
    }
    
    function Comments_add($target, $targetType, $username, $name, $title, $comment) {
        global $_SETTINGS;
        $target = addslashes($target);
        $targetType = addslashes($targetType);
        $username = addslashes($username);
        $name = addslashes($name);
        $title = addslashes($title);
        $comment = addslashes($comment);
        
        $ip = $_SERVER['REMOTE_ADDR'];
        if($username != '') {
            $query = "INSERT INTO " . $_SETTINGS['database']['prefix'] . "comments (target, targetType, username, IP, title, comment, commentedOn) VALUES ('$target', '$targetType', '$username', '$ip', '$title', '$comment', NOW());";
        }
        else {
            $query = "INSERT INTO " . $_SETTINGS['database']['prefix'] . "comments (target, targetType, name, IP, title, comment, commentedOn) VALUES ('$target', '$targetType', '$name', '$ip', '$title', '$comment', NOW());";
        }
        
        db_update_all($query);
    }

?>