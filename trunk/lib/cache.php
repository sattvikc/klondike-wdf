<?php if(!defined('KLONDIKE_VER')) die("Access denied! Are you trying to hack???"); ?>
<?php

    function cache_write($url, $app, $data) {
        $fname = $url . $app;
        $fname = base64_encode($fname);
        $fname = WPATH . 'var' . DS . 'cache' . DS . $fname . '.cache';
        file_compress_write($fname, $data);
    }
    
    function cache_read($url, $app) {
        $fname = $url . $app;
        $fname = base64_encode($fname);
        $fname = WPATH . 'var' . DS . 'cache' . DS . $fname . '.cache';
        return file_read_decompress($fname);
    }
    
    function cache_invalidate($url, $app) {
        $fname = $url . $app;
        $fname = base64_encode($fname);
        $fname = WPATH . 'var' . DS . 'cache' . DS . $fname . '.cache';
        unlink($fname);
    }

?>
