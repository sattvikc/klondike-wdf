<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Comments extends App {
        
        //views
        public function Responses_view() {
            $params = $this->_APP['parameters'];
            global $_SETTINGS;
            
            $comments = $this->getAll();
            
            if( count($comments) == 0) {
                $this->_CONTENT->Create();
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
                $this->_CONTENT->CEcho('text', stripslashes($comment['commentText']));
            }
        }
        
        //Models
        public function getAll() {
            $params = $this->_APP['parameters'];
            global $_SETTINGS;
            $target = $params['target'];
            $targetType = $params['targetType'];
            return Database::Select('*', "comments", "target='$target' AND targetType='$targetType'");
        }
    }
    
?>