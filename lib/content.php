<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    global $CONTENT;
    
    
    function content_start() {
        global $CONTENT;
        $CONTENT = array();
    }
    
    function content_end() {
        global $CONTENT, $_CUR_REGION, $CUR_THEME;
        if (isset ($_CUR_REGION) && $_CUR_REGION != '') {
            include WPATH . 'share' . DS . 'themes' . DS . $CUR_THEME . DS . $_CUR_REGION . '.php';
        }
        else {
            foreach ( $CONTENT as $text) {
                echo $text;
            }
        }
    }
    
    function content_echo($subregion, $text) {
        global $CONTENT;
        if ( isset($CONTENT[$subregion]) ) {
            $CONTENT[$subregion] .= $text;
        }
        else {
            $CONTENT[$subregion] = $text;
        }
    }
?>