<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', 'Page List');
            
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info, TRUE));
            }
            
            global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $SUB_URL;
            
            $pages = dir_get_files(WPATH . 'etc' . DS . 'pages');
            sort($pages);
            $this->_CONTENT->CEcho('text', Form::Start('newPage'));
            $this->_CONTENT->CEcho('text', "<table class=\"datatable\">\n");
            $i = 0;
            foreach($pages as $page) {
                $page = str_replace('.yaml', '', $page);
                
                if($i % 2 == 0)
                    $this->_CONTENT->CEcho('text', "<tr>\n");
                
                $this->_CONTENT->CEcho('text', '<td style="width: 170px;"><a href="' . url_generate($MAIN_URL . '/' . $page). '">');
                $this->_CONTENT->CEcho('text', $page);
                $this->_CONTENT->CEcho('text', "</a></td>\n");
                
                $this->_CONTENT->CEcho('text', '<td  style="width: 230px;">');
                $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_' . $page . '_delete', 'Delete', NULL, TRUE));
                $this->_CONTENT->CEcho('text', "</td>\n");
                
                if($i % 2 == 1)
                    $this->_CONTENT->CEcho('text', "</tr>\n");
                $i++;
            }
            if($i % 2 == 1)
                $this->_CONTENT->CEcho('text', "<td></td><td></td></tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            
            $this->_CONTENT->CEcho('text', '<td style="width: 170px;">');
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_pageName', 'newpage'));
            $this->_CONTENT->CEcho('text', "</td>\n");
            
            $this->_CONTENT->CEcho('text', '<td colspan="3">');
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_create', 'Create', NULL, TRUE));
            $this->_CONTENT->CEcho('text', "</td>\n");
            
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "</table>\n");
            $this->_CONTENT->CEcho('text', "<p><i>Warning: Creating page with existing name will replace the old one!</i></p>");
            $this->_CONTENT->CEcho('text', Form::End());
?>