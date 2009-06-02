<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class CustomHtml extends App {
        
        public function default_view() {
            $params = $this->_APP['parameters'];
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', $params['title']);
            $this->_CONTENT->CEcho('text', $params['text']);
        }
        
    }
    
?>