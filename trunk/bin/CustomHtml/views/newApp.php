<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            global $_SETTINGS;
            
            $pgYaml = yaml_load(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml", true);
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', "New App");
            
            if('default' != $pgYaml['theme']) 
                $theme = $pgYaml['theme'];
            else
                $theme = $_SETTINGS['theme']['name'];
            
            $regions = yaml_load(WPATH . 'share' . DS . 'themes' . DS . $theme . DS . "templates.yaml");
            $regions = $regions['templates'];
            
            $templates = array();
            foreach ( $regions as $region ) {
                $templates[$region] = $region;
            }
            
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info, TRUE));
            }
            
            $this->_CONTENT->CEcho('text', Form::Start('new_app'));
            $this->_CONTENT->CEcho('text', "<table>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">AppId</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_appId', '', NULL));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">App</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $appList = dir_get_dirs(WPATH . 'bin' . DS);
            $appList = array_combine($appList, $appList);
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_app', '', NULL, $appList));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            $this->_CONTENT->CEcho('text', "<script type=\"text/javascript\">\n");
            $this->_CONTENT->CEcho('text', "$('#$APP_ID" . "_app').jselect({replaceAll: false, onChange: function(value,text) { \n");
            $this->_CONTENT->CEcho('text', "  $('#$APP_ID" . "_view').jselect({replaceAll: true, loadUrl: '" . WURL ."', loadData: 'script=getViews&app='+value, loadDataType: 'json'});\n");
            $this->_CONTENT->CEcho('text', "  $('#$APP_ID" . "_controller').jselect({replaceAll: true, loadUrl: '" . WURL ."', loadData: 'script=getActions&app='+value, loadDataType: 'json'});\n");
            $this->_CONTENT->CEcho('text', " }});\n");
            $this->_CONTENT->CEcho('text', "</script>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">View</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_view', '', NULL, array()));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Controller</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_controller', '', NULL, array()));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Load Condition</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_condition', '', NULL, 50));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Ajaxify</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $appList = dir_get_dirs(WPATH . 'bin' . DS);
            $appList = array_combine($appList, $appList);
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_ajaxify', 'no', NULL, array('yes'=>'yes', 'no'=>'no')));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Ajax Reload</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_ajaxReload', '', NULL, 50));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Permission</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_rule', '', NULL, array(''=>'Select a Rule', 'allowUser'=>'allowUser', 'denyUser'=>'denyUser', 'allowGroup'=>'allowGroup', 'denyGroup'=>'denyGroup')));
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_ruleParam', '', NULL, 40));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Template</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_template', '', NULL, $templates));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Parameters</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::TextArea($APP_ID . '_params', '', NULL, 50, 8));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Sub-Regions</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::TextArea($APP_ID . '_subregions', '', NULL, 50, 8));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "</table>\n");
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_add', "Add"));
            $this->_CONTENT->CEcho('text', Form::End());

?>