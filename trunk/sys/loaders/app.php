<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function app_load($app) {
        $funcName = $app['app'] . "_" . $app['view'] . "_view";
        if(isset( $app['condition']) && $app['condition'] != 1) { return; }
        if(isset( $app['allowUser'] )) {
            if ( !isset($_SESSION['authenticated_user'])) { return; }
            $allowedUsers = split(',', $app['allowUser']);
            
            if( !in_array( $_SESSION['authenticated_user'], $allowedUsers) ) { return; }
        }
        
        if(isset( $app['denyUser'] )) {
            if ( isset($_SESSION['authenticated_user'])) {
                $deniedUsers = split(',', $app['denyUser']);
                
                if( in_array( $_SESSION['authenticated_user'], $deniedUsers) ) { return; }
            }
        }
        
        if(! function_exists($funcName)) { // Check if app's code was included. If not, include it.
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'model.php');
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'controller.php');
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'view.php');
        }
        
        if($app['controller'] != 'none') { // Execute the Controller
            $funcName = $app['app'] . "_" . $app['controller'] . "_controller";
            call_user_func_array($funcName, array($app['parameters'], $app['subregions']));
        }
        
        if($app['view'] != 'none') { // Execute the View
            $funcName = $app['app'] . "_" . $app['view'] . "_view";
            call_user_func_array($funcName, array($app['parameters'], $app['subregions']));
        }
    }
    
?>
