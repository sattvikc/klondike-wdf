<?php

    function state_read($page, $appID, $varName)
    {
        $path = $page . ':' . $appID . ':' . $varName;
        $keys = array_keys($_SESSION);
        if(in_array($path, $keys)) {
            return $val = $_SESSION[$path];
        }
        else {
            return false;
        }
    }

    function state_write($page, $appID, $varname, $value)
    {
        $path = $page . ':' . $appID . ':' . $varName;
        $_SESSION[$path] = $value;  
    }
    
    function state_quick_read($varName)
    {
        global $MAIN_URL, $APP_ID;
        $path = $MAIN_URL . ':' . $APP_ID . ':' . $varName;
        $keys = array_keys($_SESSION);
        if(in_array($path, $keys)) {
            return $val = $_SESSION[$path];
        }
        else {
            return false;
        }
    }
    
    function state_quick_write($varName, $value)
    {
        global $MAIN_URL, $APP_ID;
        $path = $MAIN_URL . ':' . $APP_ID . ':' . $varName;
        $_SESSION[$path] = $value;
    }
?>