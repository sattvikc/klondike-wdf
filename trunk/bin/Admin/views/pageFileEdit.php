<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_pageFileEdit_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        if(count($SUB_URL) == 2 && $SUB_URL[1] == 'edit') {

            echo form_start('fileEdit');
            
            $page = WPATH . 'etc' . DS . 'pages' . DS . $SUB_URL[0];
            echo form_textarea($APP_ID . '_file_contents', file_read($page), 'text', 80, 20);
            echo "<br />\n";
            echo form_link_button($APP_ID . '_save', 'Save', 'fileEdit');
            
            echo form_end();
        }
    }
?>