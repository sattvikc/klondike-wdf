<?php

    function url_get_page_yaml() {
        $parts = split("/", $_SERVER['PATH_INFO']);
        return $parts[1] . ".yaml";
    }
    
    function url_generate($url) {
        global $_SETTINGS;
        if($_SETTINGS['basic']['urltype'] == 'noht') {
            return WURL . 'index.php/' . $url;
        }
    }
?>
