<?php if(!defined('KLONDIKE_VER')) die("Access denied! Are you trying to hack???"); ?>
<?php
    
    function theme_load_head() {
        global $_SETTINGS;
        include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . 'head.php';
    }
    
    function theme_load_body() {
        global $_SETTINGS;
        include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . 'body.php';
    }

?>
