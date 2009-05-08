<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_pageBasicEdit_controller($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        if(count($SUB_URL) == 2 && $SUB_URL[1] == 'edit') {
            $pgYaml = yaml_load(WPATH . 'etc' . DS . 'pages' . DS . $SUB_URL[0]);
            if( isset($_POST[$APP_ID . '_save']) && $_POST[$APP_ID . '_save'] == 'Save' )
            {
                $pgYaml['title'] = $_POST[$APP_ID . '_title'];
                $pgYaml['type'] = $_POST[$APP_ID . '_type'];
                $pgYaml['theme'] = $_POST[$APP_ID . '_theme'];
                
                file_write(WPATH . 'etc' . DS . 'pages' . DS . $SUB_URL[0], Spyc::YAMLDump($pgYaml));
            }
        }
    }
?>