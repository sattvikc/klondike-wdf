<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            
            $theme_list = array('default' => 'Default Theme');
            $themes = dir_get_dirs(WPATH . 'share' . DS . 'themes');
            foreach ($themes as $theme) {
                if('admin' != $theme)
                    $theme_list[$theme] = $theme;
            }
            $pgYaml = yaml_load(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml", true);
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', "Basic");
            
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info, TRUE));
            }
            
            $this->_CONTENT->CEcho('text', Form::Start('save_page_basic'));
            $this->_CONTENT->CEcho('text', "<table>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Title</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_title', $pgYaml['title'], NULL));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td>Type</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_type', $pgYaml['type'], NULL, array('page' => 'Page', 'api' => 'API')));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td>Theme</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_theme', $pgYaml['theme'], NULL, $theme_list));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "</table>\n");
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_save', "Save"));
            $this->_CONTENT->CEcho('text', Form::End());
?>