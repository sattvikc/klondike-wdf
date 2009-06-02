<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Items extends App {
        
        public function default_view() {
            $params = $this->_APP['parameters'];
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('text', "<div id=\"items\">\n");
            foreach($params['items'] as $item) {
                $this->_CONTENT->CEcho('text', "<table>\n");
                $this->_CONTENT->CEcho('text', "<tr>\n");
                $this->_CONTENT->CEcho('text', "<td rowspan=\"2\" class=\"icon\"><img src=\"" . WURL . "share/resources/Items/$item[icon]\" /></td>\n");
                $this->_CONTENT->CEcho('text', "<td class=\"itemTitle\"><a href=\"" . url_generate($item['url']) . "\">$item[title]</a></td>\n");
                $this->_CONTENT->CEcho('text', "</tr>\n");
                $this->_CONTENT->CEcho('text', "<tr>\n");
                $this->_CONTENT->CEcho('text', "<td class=\"itemDescription\">$item[description]</td>\n");
                $this->_CONTENT->CEcho('text', "</tr>\n");
                $this->_CONTENT->CEcho('text', "</table>\n");
            }
            $this->_CONTENT->CEcho('text', "</div>\n");
        }
    }
    
?>