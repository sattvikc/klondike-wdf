<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function Blog_getPosts($blogName, $pageNum=-1, $pageSize=-1) {
        global $_SETTINGS, $SUB_URL;
        if( $pageNum != -1) {
            $query = "SELECT * FROM " . $_SETTINGS['database']['prefix'] . "blog_post WHERE BlogName='$blogName' ORDER BY `When` DESC LIMIT " . $pageNum * $pageSize ."," . $pageSize . ";";
        }
        else {
            $query = "SELECT * FROM " . $_SETTINGS['database']['prefix'] . "blog_post WHERE BlogName='$blogName' ORDER BY `When` DESC;";
        }
        return db_fetch_all($query);
    }
    
    function Blog_getPostsByTag($blogName, $tag) {
    
    }
    
    function Blog_getPost($id) {
        global $_SETTINGS, $SUB_URL;
        $query = "SELECT * FROM " . $_SETTINGS['database']['prefix'] . "blog_post WHERE `Id`='$id'";
        return db_fetch_all($query);
    }

?>