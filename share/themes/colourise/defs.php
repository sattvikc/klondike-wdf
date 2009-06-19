<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Colourise {
        public function contentStart() { return ''; }
        public function contentEnd() { return ''; }
        public function commentStart() { return '<ol>'; }
        public function commentEnd() { return '</ol>'; }
        public function menuStart() { return ''; }
        public function menuEnd() { return ''; }
        public function rightStart() { return ''; }
        public function rightEnd() { return ''; }
        public function userStart() { return ''; }
        public function userEnd() { return ''; }
        
        public function content($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'colourise' . DS . 'content.template', $content);
        }
        
        public function comment($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'colourise' . DS . 'comment.template', $content);
        }

        public function menu($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'colourise' . DS . 'menu.template', $content);
        }
        
        public function right($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'colourise' . DS . 'right.template', $content);
        }
        
        public function user($content) {
            return Template::RenderTemplate(WPATH . 'share' . DS . 'themes' . DS . 'colourise' . DS . 'user.template', $content);
        }
    }
    
    Template::$CURRENT = &new Colourise;
    
?>