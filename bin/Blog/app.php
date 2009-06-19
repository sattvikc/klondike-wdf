<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Blog extends App {
        
        public function Posts_view() {
            $params = $this->_APP['parameters'];
            global $MAIN_URL, $SUB_URL;
            
            if ( count($SUB_URL) == 0 ) {
                $blogPosts = $this->getPosts( $params['blogName'], -1, -1 );
            }
            else if ( count($SUB_URL) == 2 && 'post' == $SUB_URL[0] ) {
                $blogPosts = $this->getPost( $SUB_URL[1] );
            }
            
            if( count($blogPosts) == 0) {
                $this->_CONTENT->Create();
                $this->_CONTENT->CEcho('title', 'No Posts');
                $this->_CONTENT->CEcho('text', "No posts match your criteria!");
                return;
            }
            
            foreach( $blogPosts as $blogPost) {
                $this->_CONTENT->Create();
                $this->_CONTENT->CEcho('title', '<a href="' . url_generate($MAIN_URL . '/post/' . $blogPost['Id']) . '">' . $blogPost['Title'] . '</a>');
                
                if ( count($SUB_URL) == 0 ) {
                    $this->_CONTENT->CEcho('text', $blogPost['readmore']);
                }
                else if ( count($SUB_URL) == 2 && 'post' == $SUB_URL[0] ) {
                    $this->_CONTENT->CEcho('text', $blogPost['Message']);
                }
                
                if(isset($params['postedOnText']))
                    $this->_CONTENT->CEcho('datetime', $params['postedOnText'] . ' ');
                else
                    $this->_CONTENT->CEcho('datetime', "Posted on ");
                
                if(isset($params['dateFormat']))
                    $this->_CONTENT->CEcho('datetime', strftime($params['dateFormat'], strtotime($blogPost['postedOn'])));
                else
                    $this->_CONTENT->CEcho('datetime', $blogPost['postedOn']);
                
                if(isset($params['authorText']))
                    $this->_CONTENT->CEcho('author', $params['authorText'] . ' ');
                else
                    $this->_CONTENT->CEcho('author', "By ");
                
                $this->_CONTENT->CEcho('author', $blogPost['Author']);
                if ( count($SUB_URL) == 0 )
                    $this->_CONTENT->CEcho('readmore', '<a href="' . url_generate($MAIN_URL . '/post/' . $blogPost['Id']) . '">Read More</a>');
            }
        }
        
        
        
        
        
        //Models
        function getPosts($blogName, $pageNum=-1, $pageSize=-1) {
            global $_SETTINGS, $SUB_URL;
            if( $pageNum != -1) {
                return Database::Select('*', "blog_post", "BlogName='$blogName'", "`postedOn` DESC", $pageNum * $pageSize, $pageSize);
            }
            else {
                return Database::Select('*', "blog_post", "BlogName='$blogName'", "`postedOn` DESC");
            }
        }
        
        function getPost($id) {
            global $_SETTINGS, $SUB_URL;
            return Database::Select('*', "blog_post", "`Id`='$id'");
        }
    }
    
?>