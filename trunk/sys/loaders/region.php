<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    //This function will be called from a theme
    function region_theme_load($regionName) {
        $pageYaml = WPATH . "etc" . DS . "pages" . DS . url_get_page_yaml();
        
        region_load($pageYaml, $regionName);
    }
    
    //This function will be recursively called for inherited pages
    function region_load($pageYaml, $regionName) {
        global $_CUR_REGION;
        $_CUR_REGION = $regionName;
        $page = yaml_load($pageYaml);
        if(is_array($page['inherit']['start'])) { // Load the pages inherited in start section
            foreach($page['inherit']['start'] as $pgYaml) {
                if($pgYaml != 'none')  { 
                    $pgYaml = WPATH . "etc" . DS . "pages" . DS . $pgYaml;
                    region_load($pgYaml, $regionName); 
                }
            }
        }
        
        global $APP_ID;
        global $MAIN_URL, $SUB_URL;
        
        if(isset($page['regions'][$regionName])) {
            foreach($page['regions'][$regionName] as $appId => $app) {
                $APP_ID = $appId;
                if(!cache_exists($MAIN_URL, $APP_ID))
                {
                    ob_start();
                    app_load($app);
                    $data=ob_get_contents();
                    cache_write($MAIN_URL, $APP_ID, $data) ;
                    ob_clean();
                    echo $data;
                }
                else
                {
                    echo cache_read($MAIN_URL, $APP_ID) ;
                }
            }
        }
        
        if(is_array($page['inherit']['end'])) { // Load the pages inherited in end section
            foreach($page['inherit']['end'] as $pgYaml) {
                if($pgYaml != 'none')  { 
                    $pgYaml = WPATH . "etc" . DS . "pages" . DS . $pgYaml;
                    region_load($pgYaml, $regionName); 
                }
            }
        }
    }

?>
