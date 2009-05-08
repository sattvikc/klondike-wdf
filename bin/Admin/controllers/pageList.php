<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_pageList_controller($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        if ( isset($_POST[$APP_ID . '_page_create']) && $_POST[$APP_ID . '_page_create'] == 'Create' ) {
            $fileName = $_POST[$APP_ID . '_pageName'];
            
            $newPage = array( 
                              'title'   => 'Page Title',
                              'type'    => 'page',
                              'theme'   => 'default',
                              'inherit' => array( 
                                                   'start' => array('none'),
                                                   'end' => array('none')
                                                ), 
                              'regions' => array()
                            );
            file_write( WPATH . 'etc' . DS . 'pages' . DS . $fileName, Spyc::YAMLDump($newPage));
        }
        
    }
?>