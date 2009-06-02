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
    
    //Load system definitions
    require_once('sys' . DS . 'defs' . DS . 'app.php');
    require_once('sys' . DS . 'defs' . DS . 'content.php');
    require_once('sys' . DS . 'defs' . DS . 'template.php');
    
    //Load the loaders
    require_once('sys' . DS . 'loaders' . DS . 'page.php');
    require_once('sys' . DS . 'loaders' . DS . 'theme.php');
    require_once('sys' . DS . 'loaders' . DS . 'region.php');
    require_once('sys' . DS . 'loaders' . DS . 'app.php');
    
    //Load the managers
    require_once('sys' . DS . 'managers' . DS . 'url.php');
    require_once('sys' . DS . 'managers' . DS . 'user.php');
    require_once('sys' . DS . 'managers' . DS . 'group.php');
    
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
    if($URL_PATH[1] == 'admin') {
        define('ADMIN_MODE', true);
    }
    
    $level = url_get_level();
    
    global $MAIN_URL, $SUB_URL;
    
    $SUB_URL = array_slice($URL_PATH, $level); // Unmatched part of URL
    $MAIN_URL = array_slice($URL_PATH, 1, $level-1);
    $MAIN_URL = join("/", $MAIN_URL); // Matched part of URL
    
    if(isset($_GET['script'])) {
        include WPATH . 'var' . DS . 'scripts' . DS . $_GET['script'] . '.php';
        die('');
    }
    if(isset($_POST['script'])) {
        include WPATH . 'var' . DS . 'scripts' . DS . $_POST['script'] . '.php';
        die('');
    }
    
    Page::Load();
    
    if($URL_PATH[1] == 'admin') {
        global $CUR_THEME;
        $CUR_THEME="admin";
    }
    Theme::PreLoad();
    Theme::Load();
?>
