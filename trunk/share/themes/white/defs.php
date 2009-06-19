<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class White {
        public function contentStart() { return ''; }
        public function contentEnd() { return ''; }
        public function commentStart() { return ''; }
        public function commentEnd() { return ''; }
        public function menuStart() { return ''; }
        public function menuEnd() { return ''; }
        public function rightStart() { return ''; }
        public function rightEnd() { return ''; }
        
        public function content($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'white' . DS . 'content.template', $content);
        }
        
        public function comment($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'white' . DS . 'content.template', $content);
        }

        public function menu($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'white' . DS . 'menu.template', $content);
        }
        
        public function right($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'white' . DS . 'right.template', $content);
        }
        
    }
    
    Template::$CURRENT = &new White;
    
?>