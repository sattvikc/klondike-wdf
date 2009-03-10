<?php

	define('CACHE_ENABLED', true);
	define('CACHE_EXTENSION', '.cache');
	define('CACHE_EXPIRE_HOURS', 1);

	if(CACHE_ENABLED==TRUE) {
		function save_in_cache($app) {
			$file=fopen(cachefile.CACHE_EXTENSION,"w+");
			fwrite($file,$app);
			fclose($file);
			
			return $app;
		}
	
	if(file_exists(cachefile.CACHE_EXTENSION)) {
		$last_modified=filemtime(cachefile.CACHE_EXTENSION);
		if($lastmodified>time()-(3600*CACHE_EXPIRE_HOURS)) {
			
				print file_get_contents(cachefile.CACHE_EXTENSION);
				die();
		}
		else {
		unlink(cachefile.CACHE_EXTENSION);
		}
	}
	}
	ob_start("save_in_cache");
				

    function app_load($app) {
        $funcName = $app['app'] . "_" . $app['view'] . "_view";

        if(! function_exists($funcName)) {
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'model.php');
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'controller.php');
            require_once(WPATH . "bin" . DS . $app['app'] . DS . 'view.php');
        }
        
        call_user_func_array($funcName, array($app['parameters'], $app['subregions']));
    }
    
?>
