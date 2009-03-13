<?php

    function app_load($app) {
        $funcName = $app['app'] . "_" . $app['view'] . "_view";

        if(! function_exists($funcName)) { //Check if app's code was included. If not, include it.
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'model.php');
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'controller.php');
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'view.php');
        }
        
        if($app['controller'] != 'none') {
            $funcName = $app['app'] . "_" . $app['controller'] . "_controller";
            call_user_func_array($funcName, array($app['parameters'], $app['subregions']));
        }
        
        if($app['view'] != 'none') {
            $funcName = $app['app'] . "_" . $app['view'] . "_view";
            call_user_func_array($funcName, array($app['parameters'], $app['subregions']));
        }
    }
    
?>
