<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Settings extends App {
        private $info=NULL;
        private $err=NULL;
        
        // Views
        public function basic_view() {
            global $_SETTINGS;
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', "Basic Settings");
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info, TRUE));
            }
            
            $this->_CONTENT->CEcho('text', Form::Start("basic"));
            $this->_CONTENT->CEcho('text', "<table>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Title</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_title', implode(" ", $_SETTINGS['basic']['title']), NULL, 35));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td>Tagline</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_tagline', $_SETTINGS['basic']['tagline'], NULL, 35));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td>URL Type</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_urltype', $_SETTINGS['basic']['urltype'], NULL, array('noht' => 'No HTACCESS', 'ht' => 'Use HTACCESS')));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "</table>\n");
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_save', "Save", NULL, FALSE, TRUE));
            $this->_CONTENT->CEcho('text', Form::End());
        }
        
        // Controllers
        public function basic_action() {
            global $_SETTINGS;
            $APP_ID = $this->APP_ID;
            
            if(isset($_POST[$APP_ID . '_save']) && $_POST[$APP_ID . '_save'] == 'Save') { //Save the new settings
                $_SETTINGS['basic']['title'] = split(' ', $_POST[$APP_ID . '_title']);
                $_SETTINGS['basic']['tagline'] = $_POST[$APP_ID . '_tagline'];
                $_SETTINGS['basic']['urltype'] = $_POST[$APP_ID . '_urltype'];
                
                file_write(WPATH . 'etc' . DS . 'main.yaml', Spyc::YAMLDump($_SETTINGS));
                $this->info = "Settings saved successfully!";
            }
        }
        
    }
    
?>