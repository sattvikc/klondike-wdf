<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    function theme_load_head() { // Load the <head> tag
        global $_SETTINGS;
        include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . 'head.php';
    }
    
    function theme_load_body() { // Load the body tag
        global $_SETTINGS;
        include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . 'body.php';
    }

?>
