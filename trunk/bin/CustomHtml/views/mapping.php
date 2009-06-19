<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', 'URL Mappings');
            
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info, TRUE));
            }
            
            global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $SUB_URL;
            
            $pages = dir_get_files(WPATH . 'etc' . DS . 'pages');
            sort($pages);
            $sitePages = array('' => 'Select a Page');
            foreach($pages as &$page) {
                $page = str_replace('.yaml', '', $page);
                $sitePages[$page] = $page;
            }
            
            $this->_CONTENT->CEcho('text', Form::Start('mapping'));
            $this->_CONTENT->CEcho('text', "<table class=\"datatable\">\n");
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<th>\n");
            $this->_CONTENT->CEcho('text', "URL");
            $this->_CONTENT->CEcho('text', "</th>\n");
            $this->_CONTENT->CEcho('text', "<th>\n");
            $this->_CONTENT->CEcho('text', "Page");
            $this->_CONTENT->CEcho('text', "</th>\n");
            $this->_CONTENT->CEcho('text', "<th></th><th></th></tr>\n");
            
            $mappings = yaml_load(WPATH . 'etc' . DS . 'pages.yaml', TRUE);
            $count = 0;
            foreach($mappings as $map) {
                $page = $map['yaml'];
                $url = $map['url'];
                $page = str_replace('.yaml', '', $page);
                
                $this->_CONTENT->CEcho('text', "<tr>\n");
                
                $this->_CONTENT->CEcho('text', '<td style="width: 170px;">' . $url .' - <a target="blank" href="' . url_generate($url). '">');
                $this->_CONTENT->CEcho('text', " preview ");
                $this->_CONTENT->CEcho('text', "</a></td>\n");
                $this->_CONTENT->CEcho('text', '<td style="width: 170px;"><a href="' . url_generate($MAIN_URL . '/' . $page). '">');
                $this->_CONTENT->CEcho('text', $page);
                $this->_CONTENT->CEcho('text', "</a></td>\n");
                
                $this->_CONTENT->CEcho('text', '<td  style="width: 230px;">');
                $this->_CONTENT->CEcho('text', Form::Button($APP_ID . "_$count" . '_delete', 'Delete', NULL, TRUE));
                $this->_CONTENT->CEcho('text', "</td>\n");
                
                $this->_CONTENT->CEcho('text', "</tr>\n");
                $count++;
            }
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            
            $this->_CONTENT->CEcho('text', '<td style="width: 170px;">');
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_url', '/newurl'));
            $this->_CONTENT->CEcho('text', "</td>\n");
            
            $this->_CONTENT->CEcho('text', '<td style="width: 170px;">');
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_page', '', NULL, $sitePages));
            $this->_CONTENT->CEcho('text', "</td>\n");
            
            $this->_CONTENT->CEcho('text', '<td colspan="3">');
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_create', 'Create', NULL, TRUE));
            $this->_CONTENT->CEcho('text', "</td>\n");
            
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "</table>\n");
            $this->_CONTENT->CEcho('text', Form::End());
            
            $this->_CONTENT->CEcho('text', "<br /><br />\n");
            $this->_CONTENT->CEcho('text', Form::Start('url_rewrite'));
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_rewrite', 'Generate HTACCESS'));
            $this->_CONTENT->CEcho('text', Form::End());
            $this->_CONTENT->CEcho('text', "<br /><br />\n");
?>