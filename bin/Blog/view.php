<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    function Blog_display_view($params, $subregions) {
        global $CUR_THEME, $_CUR_REGION, $_SETTINGS, $MAIN_URL, $SUB_URL;
        
        if ( count($SUB_URL) == 0 ) {
            $blogPosts = Blog_getPosts( $params['blogName'], -1, -1 );
        }
        else if ( count($SUB_URL) == 2 && 'post' == $SUB_URL[0] ) {
            $blogPosts = Blog_getPost( $SUB_URL[1] );
        }
        
        if( count($blogPosts) == 0) {
            echo "No posts match your criteria!";
            return;
        }
        
        foreach( $blogPosts as $blogPost) {
            content_start();
            content_echo($subregions['title'], '<a href="' . url_generate($MAIN_URL . '/post/' . $blogPost['Id']) . '">' . $blogPost['Title'] . '</a>');
            if ( count($SUB_URL) == 0 ) {
                content_echo($subregions['text'], $blogPost['readmore']);
            }
            else if ( count($SUB_URL) == 2 && 'post' == $SUB_URL[0] ) {
                content_echo($subregions['text'], $blogPost['Message']);
            }
            content_echo($subregions['datetime'], $blogPost['When']);
            content_echo($subregions['author'], $blogPost['Author']);
            content_echo($subregions['readmore'], '<a href="' . url_generate($MAIN_URL . '/post/' . $blogPost['Id']) . '">Read More</a>');
            content_end();
        }
    
    }
    
?>