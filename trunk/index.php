<?php
    //Start the timer
    $time_start = microtime(true);
    
    //Start the session
    session_start();

    //Define klondike version
    define('KLONDIKE_VER', 0.1);
    
    //Shorthand Directory separator
    define('DS', DIRECTORY_SEPARATOR);
    
    //Include YAML parser and load main settings using YAML parser.
    require_once('sys/parsers/yaml.php');
    $_SETTINGS = Spyc::YAMLLoad('etc/main.yaml');
    
    //More shorthands, for coder's comfort.. :)
    define('WURL', $_SETTINGS['basic']['url']);
    define('WPATH', $_SETTINGS['basic']['path']);
    
    //load the libraries
    foreach($_SETTINGS['libraries'] as $libname) {
        require_once(WPATH . 'lib' . DS . $libname . '.php');
    }
    
    //Set default PATH_INFO
    if(!isset($_SERVER['PATH_INFO'])) $_SERVER['PATH_INFO'] = '/home';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
<?php theme_load_head(); ?>
    </head>
    <body>
<?php theme_load_body(); ?>        
<?php
    //Measure Execution time
    $time_end = microtime(true);
    $time = $time_end - $time_start;
    // print time taken for checking performance
    echo "<pre>Page took $time seconds\n</pre>"; //*/    
?>
    </body>
</html>
