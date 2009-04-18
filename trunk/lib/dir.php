<?php
    function dir_get_files($path) {
        $dhandle = opendir($path);
        $files = array();

        if ($dhandle)
        {
            while (false !== ($fname = readdir($dhandle)))
            {
                if (($fname != '.') && ($fname != '..') )
                {
                    if(!is_dir( "$path" . DS. "$fname" ))
                    {
                        $files[]= $fname;
                    }
                
                }
            }
        }
        closedir($dhandle);
        return $files;
    }

    function dir_get_dirs($path) {
        $dhandle = opendir($path);
        $files = array();

        if ($dhandle)
        {
            while (false !== ($fname = readdir($dhandle)))
            {
                if (($fname != '.') && ($fname != '..') )
                {
                    if(is_dir( "$path" . DS. "$fname" ))
                    {
                        $files[]= $fname;
                    }
                }
            }
        }
        closedir($dhandle);
        return $files;
    }
?>