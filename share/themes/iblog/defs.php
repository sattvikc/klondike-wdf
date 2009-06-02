<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class iBlog {
        public function contentStart() { return ''; }
        public function contentEnd() { return ''; }
        public function commentStart() { return ''; }
        public function commentEnd() { return ''; }
        public function menuStart() { return ''; }
        public function menuEnd() { return ''; }
        public function rightStart() { return ''; }
        public function rightEnd() { return ''; }
        
        public function content($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'iblog' . DS . 'content.template', $content);
        }
        
        public function comment($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'iblog' . DS . 'content.template', $content);
        }

        public function menu($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'iblog' . DS . 'menu.template', $content);
        }
        
        public function right($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'iblog' . DS . 'right.template', $content);
        }
        
    }
    
    Template::$CURRENT = &new iBlog;
    
?>