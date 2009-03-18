<?php if(!defined('KLONDIKE_VER')) die("Access denied! Are you trying to hack???"); ?>
<?php

    // Write $data into the file $filename
    function file_write ($filename, $data) {
        $fd = fopen($filename, 'w') or die("Can't open file $filename for write!");
        fwrite($fd, $data);
        fclose($fd);
    }
    
    //Read data from file $filename and return it as a string
    function file_read ($filename) {
        $fd = fopen($filename, 'r') or die("Can't open file $filename for read!");
        $theData = fread($fd, filesize($filename));
        fclose($fd);
        return $theData;
    }
    
    // Compress the data before writing to disk
    function file_compress_write ($filename, $data) {
        $fd = fopen($filename, 'w') or die("Can't open file $filename for write!");
        fwrite($fd, gzcompress($data, 9));
        fclose($fd);
    }

    function file_read_decompress ($filename) {
        $fd = fopen($filename, 'r') or die("Can't open file $filename for read!");
        $theData = fread($fd, filesize($filename));
        fclose($fd);
        return gzuncompress($theData);
    }


?>
