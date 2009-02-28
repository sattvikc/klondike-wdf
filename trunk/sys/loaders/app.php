<?php

    function app_load($app) {
        $funcName = $app['app'] . "_" . $app['view'] . "_view";

        if(! function_exists($funcName)) {
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'model.php');
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'controller.php');
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'view.php');
        }
        
        $content = call_user_func_array($funcName, $app['parameters']);
    }
    
?>
