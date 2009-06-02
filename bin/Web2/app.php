<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Web2 extends App {
        
        public function Youtube_view() {
            $params = $this->_APP['parameters'];
            
            $videoId = $params['videoId'];
            $width = $params['width'];
            $height = $params['height'];
            $allowFullScreen = $params['allowFullScreen'];
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', $params['title']);
            $this->_CONTENT->CEcho('text', "<object width=\"$width\" height=\"$height\"><param name=\"movie\" value=\"http://www.youtube.com/v/$videoId&hl=en&fs=1\"></param><param name=\"allowFullScreen\" value=\"$allowFullScreen\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"http://www.youtube.com/v/$videoId&hl=en&fs=1\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"$allowFullScreen\" width=\"$width\" height=\"$height\"></embed></object>");
        }
        
    }
    
?>