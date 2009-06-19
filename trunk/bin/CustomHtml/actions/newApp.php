<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            
            $pgYaml = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml");
            if(isset($_POST[$APP_ID . '_add']) && 'Add' == $_POST[$APP_ID . '_add']) {
                $appId = $_POST[$APP_ID . '_appId'];
                $app = array();
                $app['app'] = $_POST[$APP_ID . '_app'];
                $app['view'] = $_POST[$APP_ID . '_view'];
                $app['controller'] = $_POST[$APP_ID . '_controller'];
                if('' != $_POST[$APP_ID . '_condition'])
                    $app['condition'] = $_POST[$APP_ID . '_condition'];
                $app['ajaxify'] = $_POST[$APP_ID . '_ajaxify'];
                if('' != $_POST[$APP_ID . '_ruleParam'])
                    $app[$_POST[$APP_ID . '_rule']] = $_POST[$APP_ID . '_ruleParam'];
                if('' != $_POST[$APP_ID . '_ajaxReload']) $app['ajaxReload'] = $_POST[$APP_ID . '_ajaxReload'];
                $app['template'] = $_POST[$APP_ID . '_template'];
                $app['parameters'] = Spyc::YAMLLoad($_POST[$APP_ID . '_params']);
                $app['subregions'] = Spyc::YAMLLoad($_POST[$APP_ID . '_subregions']);
                
                if((!isset($pgYaml['regions']['dummy'])) || (!is_array($pgYaml['regions']['dummy'])) )
                    $pgYaml['regions']['dummy'] = array();
                
                $pgYaml['regions']['dummy'][$appId] = $app;
                
                file_write(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml", Spyc::YAMLDump($pgYaml));
                $this->info = "New App was added to the Page!";
            }
?>