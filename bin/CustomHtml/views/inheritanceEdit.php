<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            
            $pgYaml = yaml_load(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml", true);
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', "Inheritance");
            
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info, TRUE));
            }
            
            $this->_CONTENT->CEcho('text', Form::Start('save_page_inheritance'));
            $this->_CONTENT->CEcho('text', "<table>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Start</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $start = (is_array($pgYaml['inherit']['start']))?implode(',',$pgYaml['inherit']['start']):'';
            $start = str_replace('.yaml', '', $start);
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_start', $start, NULL, 50));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td>End</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $end = (is_array($pgYaml['inherit']['end']))?implode(',', $pgYaml['inherit']['end']):'';
            $end = str_replace('.yaml', '', $end);
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_end', $end, NULL, 50));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "</table>\n");
            $this->_CONTENT->CEcho('text', "<p><i>Seperate each page you want to inherit seperated by comma.</i></p>\n");
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_save', "Save"));
            $this->_CONTENT->CEcho('text', Form::End());
?>