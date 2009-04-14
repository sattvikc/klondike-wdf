<?php
    //Start the timer
    $time_start = microtime(true);
    
    //Start the session
    session_start();

    //Define klondike version
    define('KLONDIKE_VER', '1.0');
    
    //Shorthand Directory separator
    define('DS', DIRECTORY_SEPARATOR);
    
    //Include YAML parser and load main settings using YAML parser.
    require_once('sys' . DS . 'parsers' . DS . 'yaml.php');

    global $_SETTINGS;
    $_SETTINGS = yaml_load('etc/main.yaml');
    
    //Load the loaders
    require_once('sys/loaders/theme.php');
    require_once('sys/loaders/region.php');
    require_once('sys/loaders/app.php');
    
    //Load the managers
    require_once('sys/managers/url.php');
    
    //More shorthands, for coder's comfort.. :)
    define('WURL', $_SETTINGS['basic']['url']);
    define('WPATH', $_SETTINGS['basic']['path']);
    
    //load the libraries
    foreach($_SETTINGS['libraries'] as $libname) {
        require_once(WPATH . 'lib' . DS . $libname . '.php');
    }
    
    //Set default PATH_INFO
    if(!isset($_SERVER['PATH_INFO'])) 
        $_SERVER['PATH_INFO'] = '/home';
    else if($_SERVER['PATH_INFO'] == '/')
        $_SERVER['PATH_INFO'] = '/home';

    global $URL_PATH;
    $URL_PATH = split('/', $_SERVER['PATH_INFO']);
    
    $level = url_get_level();
    
    global $MAIN_URL, $SUB_URL;
    
    $SUB_URL = array_slice($URL_PATH, $level);
    $MAIN_URL = array_slice($URL_PATH, 1, $level-1);
    $MAIN_URL = join("/", $MAIN_URL);

    
    if($URL_PATH[1] == 'admin') {
        define('ADMIN_MODE', true);
        include WPATH . 'sys' . DS . 'admin' . DS . 'index.php';
        die('');
    }
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
    echo "<center><pre>Page took $time seconds\n</pre></center>"; //*/    
?>
    </body>
</html>
