<?php

    function url_match($url1, $url2) {
        $i = 0;
        $surl1 = split("/", $url1);
        $surl2 = split("/", $url2); // break apart the urls
        
        $minDepth = (count($surl1) < count($surl2))? count($surl1) : count($surl2); // match until smallest url parts
        
        while($i < $minDepth) {
            if($surl1[$i] != $surl2[$i]) return $i; // Matched upto $i level
            $i++;
        }
        return 1000; // This is the best match.
    }
    
    function url_get_page_yaml() {
        $parts = split("/", $_SERVER['PATH_INFO']);
        $urls = yaml_load(WPATH . 'etc' . DS . 'pages.yaml');
        
        $pgYaml = "404.yaml"; // Bad match should result in 404 - Page not found error.
        $matchMax = 1; // Any 2 random urls will match to 1 level
        foreach($urls as $url) {
            $matchCount = url_match($_SERVER['PATH_INFO'], $url['url']);
            if($matchCount > $matchMax) {
                $pgYaml = $url['yaml'];
                $matchMax = $matchCount; // update better matches
            }
        }
        return $pgYaml;
    }
    
    function url_generate($url) {
        global $_SETTINGS;
        if($_SETTINGS['basic']['urltype'] == 'noht') {
            return WURL . 'index.php/' . $url; // Not using htaccess to rename urls.
        }
    }
?>
