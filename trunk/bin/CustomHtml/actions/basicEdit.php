<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            
            $pgYaml = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml");
            if(isset($_POST[$APP_ID . '_save']) && 'Save' == $_POST[$APP_ID . '_save']) {
                $pgYaml['title'] = $_POST[$APP_ID . '_title'];
                $pgYaml['type'] = $_POST[$APP_ID . '_type'];
                $pgYaml['theme'] = $_POST[$APP_ID . '_theme'];
                file_write(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml", Spyc::YAMLDump($pgYaml));
                $this->info = "Page Saved!";
            }
?>