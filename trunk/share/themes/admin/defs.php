<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class adminTheme {
        public function contentStart() { return ''; }
        public function contentEnd() { return ''; }
        public function leftStart() { return ''; }
        public function leftEnd() { return ''; }
        
        public function content($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'admin' . DS . 'content.template', $content);
        }
        
        public function left($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'admin' . DS . 'left.template', $content);
        }
    }
    
    Template::$CURRENT = &new adminTheme;
    
?>