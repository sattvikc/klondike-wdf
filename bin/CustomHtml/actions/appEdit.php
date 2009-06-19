<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            
            $pgYaml = Spyc::YAMLLoad(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml");
            if(isset($_POST[$APP_ID . '_save']) && 'Save' == $_POST[$APP_ID . '_save']) {
                $positions = $_POST[$APP_ID . '_positions'];
                $regions = explode('|', $positions);
                $appInRegions = array();
                foreach($regions as $region) {
                    $region = explode('=', $region);
                    $appsInRegions[$region[0]] = explode(',', $region[1]);
                }
                
                $pageApps = array();
                if(is_array($pgYaml['regions'])) {
                    foreach($pgYaml['regions'] as $regionName => $regionData) {
                        if(is_array($regionData)) {
                            foreach($regionData as $appId => $appData) {
                                $pageApps[$appId] = $appData;
                            }
                        }
                    }
                }
                $pgYaml['regions'] = array();
                foreach($appsInRegions as $region => $apps) {
                    if ( 'thrash' == $region ) continue;
                    $pgYaml['regions'][$region] = array();
                    foreach($apps as $appId) {
                        if('' != $appId && isset($pageApps[$appId])) {
                            $pgYaml['regions'][$region][$appId] = $pageApps[$appId];
                        }
                    }
                }
                file_write(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml", Spyc::YAMLDump($pgYaml));
                $this->info = "Page Saved!";
            }
            else {
                if(isset($_POST[$APP_ID . "_appId"])) {
                    $appId = $_POST[$APP_ID . "_appId"];
                    $app = array();
                    $app['app'] = $_POST[$APP_ID . "_app_$appId"];
                    $app['view'] = $_POST[$APP_ID . "_view_$appId"];
                    $app['controller'] = $_POST[$APP_ID . "_controller_$appId"];
                    if('' != $_POST[$APP_ID . "_condition_$appId"]) $app['condition'] = $_POST[$APP_ID . "_condition_$appId"];
                    $app['ajaxify'] = $_POST[$APP_ID . "_ajaxify_$appId"];
                    if('' != $_POST[$APP_ID . "_ajaxReload_$appId"]) $app['ajaxReload'] = $_POST[$APP_ID . "_ajaxReload_$appId"];
                    if('' != $_POST[$APP_ID . "_ruleParam_$appId"])
                        $app[$_POST[$APP_ID . "_rule_$appId"]] = $_POST[$APP_ID . "_ruleParam_$appId"];
                    $app['template'] = $_POST[$APP_ID . "_template_$appId"];
                    $app['parameters'] = Spyc::YAMLLoad($_POST[$APP_ID . "_params_$appId"]);
                    $app['subregions'] = Spyc::YAMLLoad($_POST[$APP_ID . "_subregions_$appId"]);
                    
                    if(is_array($pgYaml['regions'])) {
                        foreach($pgYaml['regions'] as $regionName => $regionData) {
                            if(is_array($regionData)) {
                                if(isset($regionData[$appId])) {
                                    $pgYaml['regions'][$regionName][$appId] = $app;
                                    break;
                                }
                            }
                        }
                    }
                    file_write(WPATH . 'etc' . DS . 'pages' . DS . $params['page'] . ".yaml", Spyc::YAMLDump($pgYaml));
                    $this->info = "App '$appId' was Updated!";
                }
                
            }
?>