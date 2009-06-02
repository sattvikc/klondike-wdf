<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Menu extends App {
        public function list_view() {
            global $CUR_THEME, $_CUR_REGION, $_SETTINGS, $URL_PATH, $MAIN_URL, $SUB_URL;
            
            $params = $this->_APP['parameters'];
            $menu = yaml_load(WPATH . 'etc' . DS . 'Menu' . DS . $params['menu'] . '.yaml');
            
            foreach($menu['items'] as $item) {
                $this->_CONTENT->Create();
                $this->_CONTENT->CEcho('url', url_generate($item['url']));
                $this->_CONTENT->CEcho('text', $item['text']);
                if($item['url'] == $MAIN_URL) $this->_CONTENT->CEcho('class', 'active'); 
            }
        }
    }
?>