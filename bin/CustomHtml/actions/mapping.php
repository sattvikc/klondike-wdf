<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            global $_SETTINGS;
            $APP_ID = $this->APP_ID;
            if(isset($_POST[$APP_ID . '_create']) && $_POST[$APP_ID . '_create'] == 'Create') {
                $mappings = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'pages.yaml', TRUE);
                $mappings []= array('url' => $_POST[$APP_ID . '_url'], 'yaml' => $_POST[$APP_ID . '_page'] . ".yaml");
                file_write( WPATH . 'etc' . DS . 'pages.yaml', Spyc::YAMLDump($mappings) );
                $this->info = "Mapping has been added successfully!";
            }
            else if(isset($_POST[$APP_ID . '_rewrite']) && $_POST[$APP_ID . '_rewrite'] == 'Generate HTACCESS') {
                $mappings = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'pages.yaml', TRUE);
                $ht = "RewriteEngine on\n";
                foreach($mappings as $mapping) {
                    $url = $mapping['url'];
                    if(strlen($url) > 0 && '/' == $url[0])
                        $url = substr($url, 1);
                    $ht .= "RewriteRule ^$url([/]?.*) index.php/$url" . '$1' . "\n";
                }
                $mappings = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'admin.yaml', TRUE);
                foreach($mappings as $mapping) {
                    $url = $mapping['url'];
                    if(strlen($url) > 0 && '/' == $url[0])
                        $url = substr($url, 1);
                    $ht .= "RewriteRule ^$url([/]?.*) index.php/$url" . '$1' . "\n";
                }
                if($_SETTINGS['basic']['urltype'] == 'noht') {
                    file_write(WPATH . "htaccess.txt", $ht);
                }
                else if($_SETTINGS['basic']['urltype'] == 'ht') {
                    file_write(WPATH . ".htaccess", $ht);
                }
                $this->info = "HTACCESS was generated successfully!";
            }
            else {
                foreach($_POST as $formField => $formData) {
                    if( "Delete" == $formData && FALSE != strpos($formField, substr($APP_ID,1)) ) {
                        $page = str_replace($APP_ID . '_', '' , $formField);
                        $page = str_replace("_delete", '', $page);
                        $index = (int)$page;
                        
                        $mappings = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'pages.yaml', TRUE);
                        array_splice($mappings, $index, 1);
                        file_write( WPATH . 'etc' . DS . 'pages.yaml', Spyc::YAMLDump($mappings) );
                        
                        $this->info = "Mapping has been deleted successfully!";
                    }
                }
            }
?>