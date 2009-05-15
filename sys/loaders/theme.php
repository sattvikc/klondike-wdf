<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    function theme_load_head() { // Load the <head> tag
        global $_SETTINGS, $CUR_THEME;
        $pageYaml = yaml_load(WPATH . "etc" . DS . "pages" . DS . url_get_page_yaml());
        if ( $pageYaml['theme'] == 'default' ) {
            $CUR_THEME = $_SETTINGS['theme']['name'];
            include WPATH . 'share' . DS . 'themes' . DS . $_SETTINGS['theme']['name'] . DS . 'head.php';
        }
        else {
            $CUR_THEME = $pageYaml['theme'];
            include WPATH . 'share' . DS . 'themes' . DS . $pageYaml['theme'] . DS . 'head.php';
        }
        echo "<title></title>\n";
    }
    
    function theme_load_body() { // Load the body tag
        global $_SETTINGS, $CUR_THEME;
        //$pageYaml = yaml_load(WPATH . "etc" . DS . "pages" . DS . url_get_page_yaml());
        //if ( $pageYaml['theme'] == 'default' )
            include WPATH . 'share' . DS . 'themes' . DS . $CUR_THEME . DS . 'body.php';
        //else
        //    include WPATH . 'share' . DS . 'themes' . DS . $pageYaml['theme'] . DS . 'body.php';
    }

?>
