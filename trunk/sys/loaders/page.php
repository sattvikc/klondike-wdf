<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Page {
        public static function Load() {
            global $_APPS;
            Page::InheritLoad(WPATH . "etc" . DS . "pages" . DS . url_get_page_yaml());
        }
        
        private static function InheritLoad($fileName) {
            global $_APPS;
            $pageYaml = yaml_load($fileName);
            //echo $fileName . "<br>";;
            if(is_array($pageYaml['inherit']['start'])) { // Load the pages inherited in start section
                foreach($pageYaml['inherit']['start'] as $pgYaml) {
                    if($pgYaml != 'none' && $pgYaml != '')  { 
                        if ( defined('ADMIN_MODE') )
                            $pgYaml = WPATH . "etc" . DS . "pages" . DS . 'admin' . DS . $pgYaml;
                        else
                            $pgYaml = WPATH . "etc" . DS . "pages" . DS . $pgYaml;
                        Page::InheritLoad($pgYaml); 
                    }
                }
            }
            
            if ( isset($pageYaml['regions']) && is_array($pageYaml['regions']) ) {
                foreach($pageYaml['regions'] as $regionName => $region) {
                    if(!is_array($region)) continue;
                    foreach($region as $appId => $app) {
                        Page::CheckAppDefinition($app['app']);
                        
                        if ( isset( $_APPS[$appId] ) ) continue; // App already loaded. Don't load again!
                        if ( isset($app['condition']) && TRUE != $app['condition'] ) continue; // Load condition failed
                        
                        // Check for allowUser rule
                        if(isset( $app['allowUser'] )) {
                            if ( !Users::$AUTH) continue; // no user logged in
                            $allowedUsers = split(',', $app['allowUser']);
                            
                            if( !in_array( Users::$AUTH_USER, $allowedUsers) ) continue; // User is not allowed
                        }
                        
                        // Check for denyUser rule
                        else if(isset( $app['denyUser'] )) {
                            if ( Users::$AUTH ) {
                                $deniedUsers = split(',', $app['denyUser']);
                                
                                if( in_array( Users::$AUTH_USER, $deniedUsers) ) continue; // User is not allowed
                            }
                        }
                        
                        //Check for allowGroup rule
                        else if(isset( $app['allowGroup'] )) {
                            if ( !Users::$AUTH) continue; // no user logged in
                            $allowedGroups = split(',', $app['allowGroup']);
                            
                            $flag = FALSE;
                            foreach( $allowedGroups as $allowedGroup) {
                                $flag = $flag || Groups::HasUser ( $allowedGroup, Users::$AUTH_USER );
                                if($flag) break;
                            }
                            if( !$flag ) continue; // User is not allowed
                        }
                        
                        //Check for denyGroup rule
                        else if(isset( $app['denyGroup'] )) {
                            if ( Users::$AUTH) {
                                $deniedGroups = split(',', $app['denyGroup']);
                                
                                $flag = FALSE;
                                foreach( $deniedGroups as $deniedGroup) {
                                    $flag = $flag || Groups::HasUser ( $deniedGroup, Users::$AUTH_USER );
                                    if($flag) break;
                                }
                                if( $flag ) continue; // User is not allowed
                            }
                        }
                        
                        eval ( "\$_APPS[\$appId] = &new " . $app['app'] . ";" ); // Create new instance of the app
                        $_APPS[$appId]->init($app, $appId); // Initialize the app
                        
                    }
                }
            }
            
            if(is_array($pageYaml['inherit']['end'])) { // Load the pages inherited in start section
                foreach($pageYaml['inherit']['end'] as $pgYaml) {
                    if($pgYaml != 'none' && $pgYaml != '')  { 
                        if ( defined('ADMIN_MODE') )
                            $pgYaml = WPATH . "etc" . DS . "pages" . DS . 'admin' . DS . $pgYaml;
                        else
                            $pgYaml = WPATH . "etc" . DS . "pages" . DS . $pgYaml;
                        Page::InheritLoad($pgYaml); 
                    }
                }
            }
        }
        
        private static function CheckAppDefinition($app) {
            if ( !class_exists ( $app ) ) {
                include_once WPATH . 'bin' . DS . $app . DS . 'app.php';
            }
        }
    }
    
?>