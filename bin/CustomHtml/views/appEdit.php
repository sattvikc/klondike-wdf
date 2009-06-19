<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            global $_SETTINGS;
            
            $pgYaml = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml");
            
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
            
            $fileName = WPATH . 'share' . DS . 'themes' . DS . $theme . DS . "layout.html";
            $subject = file_read($fileName); // Reads the template file
            $pattern = '/\{\[([a-zA-Z0-9_]*)\]\}/'; // Regular Expression to match the app placeholders {[regionName]}
            preg_match_all($pattern, $subject, $matches); // Execute the regular expression
            
            $placeHolder = "<div class=\"widget-place\" id=\"!id!\">\n";
            $placeHolder .= "</div>\n";
            
            $pageApps = array();
            
            foreach($matches[1] as $match) {
                $pageApps[$match] = "$match=";
                $subject = str_replace("{[" . $match . "]}", str_replace('!id!', $match, $placeHolder), $subject);
            }
            $pageApps['dummy'] = "dummy=";
            
            $this->_CONTENT->Create();
            
            $this->_CONTENT->CEcho('title', 'App Edit');
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info, TRUE));
            }
            
            $this->_CONTENT->CEcho('text', $subject);
            $this->_CONTENT->CEcho('text', "<table class=\"pageLayout\"><tr><td>\n");
            $this->_CONTENT->CEcho('text', "<b>No-Display</b><br />\n<div class=\"widget-place\" id=\"dummy\">\n");
            
            if(isset($pgYaml['regions']) && is_array($pgYaml['regions'])) {
                foreach($pgYaml['regions'] as $region => $regionData) {
                    if(!is_array($regionData)) continue;
                    if(in_array($region, $matches[1])) {
                        $pageApps[$region] .= implode(",", array_keys($regionData));
                    }
                    else {
                        if('=' == substr($pageApps[$region], -1))
                            $pageApps['dummy'] .= implode(",", array_keys($regionData));
                        else
                            $pageApps['dummy'] .= ',' . implode(",", array_keys($regionData));
                    }
                    if(is_array($pgYaml['regions'][$region])) {
                        foreach($pgYaml['regions'][$region] as $appId => $app) {
                            
                            $this->_CONTENT->CEcho('text', "<div class=\"widget movable collapsable collapse ui-widget ui-corner-all\" id=\"$appId\">\n");
                            $this->_CONTENT->CEcho('text', "<div class=\"widget-header ui-widget-header\">\n");
                            $this->_CONTENT->CEcho('text', "$appId\n");
                            $this->_CONTENT->CEcho('text', "</div>\n");
                            $this->_CONTENT->CEcho('text', "<div class=\"widget-content ui-widget-content\">\n");
                            
                            $this->_CONTENT->CEcho('text', Form::Start('edit_app_' . $appId));
                            $this->_CONTENT->CEcho('text', "<input type=\"hidden\" name=\"$APP_ID" . "_appId\" value=\"$appId\"></input>\n");
                            $this->_CONTENT->CEcho('text', "<table>\n");
                            
                            $this->_CONTENT->CEcho('text', "<tr>\n");
                            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">App</td>\n");
                            $this->_CONTENT->CEcho('text', "</tr><tr><td>");
                            $appList = dir_get_dirs(WPATH . 'bin' . DS);
                            $appList = array_combine($appList, $appList);
                            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . "_app_$appId", $app['app'], NULL, $appList));
                            
                            $this->_CONTENT->CEcho('text', "<script type=\"text/javascript\">\n");
                            $this->_CONTENT->CEcho('text', "$('#$APP_ID" . "_app_$appId').jselect({replaceAll: false, onChange: function(value,text) { \n");
                            $this->_CONTENT->CEcho('text', "  $('#$APP_ID" . "_view_$appId').jselect({replaceAll: true, loadUrl: '" . WURL ."', loadData: 'script=getViews&app='+value, loadDataType: 'json'});\n");
                            $this->_CONTENT->CEcho('text', "  $('#$APP_ID" . "_controller_$appId').jselect({replaceAll: true, loadUrl: '" . WURL ."', loadData: 'script=getActions&app='+value, loadDataType: 'json'});\n");
                            $this->_CONTENT->CEcho('text', " }});\n");
                            $this->_CONTENT->CEcho('text', "$('#$APP_ID" . "_app_$appId option[value=$app[app]]').attr('selected', 'selected');\n");
                            $this->_CONTENT->CEcho('text', "</script>\n");
                            
                            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
                            
                            $this->_CONTENT->CEcho('text', "<tr>\n");
                            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">View</td>\n");
                            $this->_CONTENT->CEcho('text', "</tr><tr><td>");
                            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . "_view_$appId", '', NULL, array()));
                            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
                            $this->_CONTENT->CEcho('text', "<script type=\"text/javascript\">\n");
                            $this->_CONTENT->CEcho('text', "  $('#$APP_ID" . "_view_$appId').jselect({replaceAll: true, loadUrl: '" . WURL ."', loadData: 'script=getViews&app=$app[app]&val=$app[view]', loadDataType: 'json', onComplete: function() { \n");
                            $this->_CONTENT->CEcho('text', "$('#$APP_ID" . "_view_$appId option[value=$app[view]]').attr('selected', 'selected');\n");
                            $this->_CONTENT->CEcho('text', "}});\n");
                            $this->_CONTENT->CEcho('text', "</script>\n");
                            
                            $this->_CONTENT->CEcho('text', "<tr>\n");
                            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Controller</td>\n");
                            $this->_CONTENT->CEcho('text', "</tr><tr><td>");
                            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . "_controller_$appId", '', NULL, array()));
                            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
                            $this->_CONTENT->CEcho('text', "<script type=\"text/javascript\">\n");
                            $this->_CONTENT->CEcho('text', "  $('#$APP_ID" . "_controller_$appId').jselect({replaceAll: true, loadUrl: '" . WURL ."', loadData: 'script=getActions&app=$app[app]&val=$app[controller]', loadDataType: 'json', onComplete: function() { \n");
                            $this->_CONTENT->CEcho('text', "$('#$APP_ID" . "_controller_$appId option[value=$app[controller]]').attr('selected', 'selected');\n");
                            $this->_CONTENT->CEcho('text', "}});\n");
                            $this->_CONTENT->CEcho('text', "</script>\n");
                            
                            $this->_CONTENT->CEcho('text', "<tr>\n");
                            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Condition</td>\n");
                            $this->_CONTENT->CEcho('text', "</tr><tr><td>");
                            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . "_condition_$appId", (isset($app['condition']))?$app['condition']:'', NULL, 50));
                            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
                            
                            $this->_CONTENT->CEcho('text', "<tr>\n");
                            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Ajaxify</td>\n");
                            $this->_CONTENT->CEcho('text', "</tr><tr><td>");
                            
                            $ajaxify = 'no';
                            if(isset($app['ajaxify'])) $ajaxify = $app['ajaxify'];
                            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . "_ajaxify_$appId", $ajaxify, NULL, array('yes'=>'yes', 'no'=>'no')));
                            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
                            
                            $this->_CONTENT->CEcho('text', "<tr>\n");
                            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Ajax Reload</td>\n");
                            $this->_CONTENT->CEcho('text', "</tr><tr><td>");
                            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . "_ajaxReload_$appId", (isset($app['ajaxReload']))?$app['ajaxReload']:'', NULL, 50));
                            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
                            
                            if(isset($app['allowUser'])) {$rule = 'allowUser';$ruleParam=$app[$rule];}
                            else if(isset($app['denyUser'])) {$rule = 'denyUser';$ruleParam=$app[$rule];}
                            else if(isset($app['allowGroup'])) {$rule = 'allowGroup';$ruleParam=$app[$rule];}
                            else if(isset($app['denyGroup'])) {$rule = 'denyGroup';$ruleParam=$app[$rule];}
                            else {$rule=''; $ruleParam='';}
                            $this->_CONTENT->CEcho('text', "<tr>\n");
                            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Permission</td>\n");
                            $this->_CONTENT->CEcho('text', "</tr><tr><td>");
                            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . "_rule_$appId", $rule, NULL, array(''=>'Select a Rule', 'allowUser'=>'allowUser', 'denyUser'=>'denyUser', 'allowGroup'=>'allowGroup', 'denyGroup'=>'denyGroup')));
                            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . "_ruleParam_$appId", $ruleParam, NULL, 40));
                            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
                            
                            $this->_CONTENT->CEcho('text', "<tr>\n");
                            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Template</td>\n");
                            $this->_CONTENT->CEcho('text', "</tr><tr><td>");
                            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . "_template_$appId", (isset($app['template']))?$app['template']:'content', NULL, $templates));
                            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
                            
                            $this->_CONTENT->CEcho('text', "<tr>\n");
                            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Parameters</td>\n");
                            $this->_CONTENT->CEcho('text', "</tr><tr><td>");
                            $this->_CONTENT->CEcho('text', Form::TextArea($APP_ID . "_params_$appId", Spyc::YAMLDump($app['parameters']), NULL, 41, 8));
                            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
                            
                            $this->_CONTENT->CEcho('text', "<tr>\n");
                            $this->_CONTENT->CEcho('text', "<td style=\"width: 150px;\">Sub-Regions</td>\n");
                            $this->_CONTENT->CEcho('text', "</tr><tr><td>");
                            $this->_CONTENT->CEcho('text', Form::TextArea($APP_ID . "_subregions_$appId", Spyc::YAMLDump($app['subregions']), NULL, 41, 8));
                            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
                            
                            $this->_CONTENT->CEcho('text', "</table>\n");
                            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_' . $appId . '_save', "Save"));
                            $this->_CONTENT->CEcho('text', Form::End());
                            
                            
                            $this->_CONTENT->CEcho('text', "</div>\n");
                            /*$this->_CONTENT->CEcho('text', "<div class=\"widget-content\">\n");
                            $this->_CONTENT->CEcho('text', "<p><b>App</b>: $app[app]</p>\n");
                            $this->_CONTENT->CEcho('text', "<p><b>View</b>: $app[view]</p>\n");
                            $this->_CONTENT->CEcho('text', "<p><b>Controller</b>: $app[controller]</p>\n");
                            $this->_CONTENT->CEcho('text', "</div>\n");*/
                            $this->_CONTENT->CEcho('text', "</div>\n");
                        }
                    }
                }
            }
            $serializedData = implode("|", $pageApps);
            $serializedData .= "|thrash=";
            $this->_CONTENT->CEcho('text', "</div><i>Apps placed will be executed but not displayed.</i>");
            $this->_CONTENT->CEcho('text', "</td><td>\n");
            $this->_CONTENT->CEcho('text', "<b>Thrash</b><br />\n<div class=\"widget-place\" id=\"thrash\">\n");
            $this->_CONTENT->CEcho('text', "</div><i>Placing apps here will delete them!</i><br />");
            $this->_CONTENT->CEcho('text', "</td></tr></table><br />\n");
            
            $this->_CONTENT->CEcho('text', Form::Start("app_positions"));
            $this->_CONTENT->CEcho('text', "<input type=\"hidden\" id=\"$APP_ID" . "_positions\" name=\"$APP_ID" . "_positions\" value=\"$serializedData\"></input>\n");
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . "_save", "Save"));
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . "_cancel", "Revert"));
            $this->_CONTENT->CEcho('text', Form::End());
            $this->_CONTENT->CEcho('text', "<script type=\"text/javascript\">\n");
            $this->_CONTENT->CEcho('text', "$.fn.EasyWidgets({behaviour : { useCookies : true }, i18n : {editText: '+', closeText: 'x', collapseText: '-', cancelEditText: 'c', extendText: '+'},callbacks :{ onChangePositions : function(str){ $('#$APP_ID" . "_positions').attr('value',str); },onRefreshPositions : function(){return '$serializedData';} }});\n");
            $this->_CONTENT->CEcho('text', "</script>\n");
            
            $this->_CONTENT->CEcho('text', "<script type=\"text/javascript\">\n");
            $this->_CONTENT->CEcho('text', "</script>\n");
?>