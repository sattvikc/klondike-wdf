<?php

    function url_get_page_yaml() {
        $parts = split("/", $_SERVER['PATH_INFO']);
        return $parts[1] . ".yaml";
    }
    
?>
