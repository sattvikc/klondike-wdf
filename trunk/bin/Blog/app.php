<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Blog extends App {
        
        public function display_view() {
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
                $this->_CONTENT->CEcho('datetime', $blogPost['When']);
                $this->_CONTENT->CEcho('author', $blogPost['Author']);
                $this->_CONTENT->CEcho('readmore', '<a href="' . url_generate($MAIN_URL . '/post/' . $blogPost['Id']) . '">Read More</a>');
            }
        }
        
        
        
        
        
        //Models
        function getPosts($blogName, $pageNum=-1, $pageSize=-1) {
            global $_SETTINGS, $SUB_URL;
            if( $pageNum != -1) {
                return MySQLdb::Select('*', "blog_post", "BlogName='$blogName'", "`When` DESC", $pageNum * $pageSize, $pageSize);
                //$query = "SELECT * FROM " . $_SETTINGS['database']['prefix'] . "blog_post WHERE BlogName='$blogName' ORDER BY `When` DESC LIMIT " . $pageNum * $pageSize ."," . $pageSize . ";";
            }
            else {
                return MySQLdb::Select('*', "blog_post", "BlogName='$blogName'", "`When` DESC");
                //$query = "SELECT * FROM " . $_SETTINGS['database']['prefix'] . "blog_post WHERE BlogName='$blogName' ORDER BY `When` DESC;";
            }
        }
        
        function getPost($id) {
            global $_SETTINGS, $SUB_URL;
            //$query = "SELECT * FROM " . $_SETTINGS['database']['prefix'] . "blog_post WHERE `Id`='$id'";
            return MySQLdb::Select('*', "blog_post", "`Id`='$id'");
            //return db_fetch_all($query);
        }
    }
    
?>