<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function cache_generate_filename($url, $app) {
        $fname = $url . $app;
        $fname = base64_encode($fname);
        $fname = WPATH . 'var' . DS . 'cache' . DS . $fname . '.cache';
        return $fname;
    }
    
    function cache_write($url, $app, $data) {
        $fname = cache_generate_filename($url, $app);
        file_compress_write($fname, $data);
    }
    
    function cache_read($url, $app) {
        $fname = cache_generate_filename($url, $app);
        return file_read_decompress($fname);
    }
    
    function cache_invalidate($url, $app) {
        $fname = cache_generate_filename($url, $app);
        if(file_exists($fname))
            unlink($fname);
    }
    
    function cache_exists($url, $app) {
        $fname = cache_generate_filename($url, $app);
        return file_exists($fname);
    }

?>
