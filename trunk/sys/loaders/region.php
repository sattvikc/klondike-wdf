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
        foreach($page['inherit']['start'] as $pgYaml) {
            if($pgYaml != 'none')  { 
                $pgYaml = WPATH . "etc" . DS . "pages" . DS . $pgYaml;
                region_load($pgYaml, $regionName); 
            }
        }
        
        if(isset($page['regions'][$regionName])) {
            foreach($page['regions'][$regionName] as $app) {
               app_load($app);
            }
        }
        
        foreach($page['inherit']['end'] as $pgYaml) {
            if($pgYaml != 'none')  { 
                $pgYaml = WPATH . "etc" . DS . "pages" . DS . $pgYaml;
                region_load($pgYaml, $regionName); 
            }
        }
        
        //Cleanup
        unset($page);
    }

?>
