<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            $APP_ID = $this->APP_ID;
            if(isset($_POST[$APP_ID . '_create']) && $_POST[$APP_ID . '_create'] == 'Create') {
                $fileName = $_POST[$APP_ID . '_pageName'] . ".yaml";
                
                $newPage = array( 
                                  'title'   => 'Page Title',
                                  'type'    => 'page',
                                  'theme'   => 'default',
                                  'inherit' => array( 
                                                       'start' => array(),
                                                       'end' => array()
                                                    ), 
                                  'regions' => array()
                                );
                file_write( WPATH . 'etc' . DS . 'pages' . DS . $fileName, Spyc::YAMLDump($newPage) );
            }
            else {
                foreach($_POST as $formField => $formData) {
                    if( "Delete" == $formData && FALSE != strpos($formField, substr($APP_ID,1)) ) {
                        $page = str_replace($APP_ID . '_', '' , $formField);
                        $page = str_replace("_delete", '', $page);
                        
                        unlink( WPATH . 'etc' . DS . 'pages' . DS . $page . '.yaml' );
                        //echo $page;
                        $this->info = "'$page' page has been deleted successfully!";
                    }
                }
            }
?>