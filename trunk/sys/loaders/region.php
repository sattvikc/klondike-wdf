<?php
    
    //This function shall be called from a theme
    function region_theme_load($regionName) {
        $pageYaml = WPATH . "etc" . DS . "pages" . DS . url_get_page_yaml();
        
        region_load($pageYaml, $regionName);
    }
    
    function region_load($pageYaml, $regionName) {
        
        $page = Spyc::YAMLLoad($pageYaml);
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
