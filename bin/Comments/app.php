<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Comments extends App {
        
        //views
        public function responses_view() {
            $params = $this->_APP['parameters'];
            global $_SETTINGS;
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', $params['title']);
            
            $comments = $this->getAll();
            
            if( count($comments) == 0) {
                $this->_CONTENT->CEcho('text', "No comments to display!");
                return;
            }
            
            foreach( $comments as $comment) {
                $this->_CONTENT->Create();
                if(isset($comment['username']) && $comment['username'] != '') {
                    $this->_CONTENT->CEcho('title', $comment['username']);
                }
                else {
                    $this->_CONTENT->CEcho('title', $comment['name']);
                }
                $this->_CONTENT->CEcho('datetime', $comment['commentedOn']);
                $this->_CONTENT->CEcho('text', $comment['comment']);
            }
        }
        
    }
    
?>