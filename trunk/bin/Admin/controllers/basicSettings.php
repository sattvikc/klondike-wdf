<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_basicSettings_controller($params) {
        global $APP_ID, $MAIN_URL, $_SETTINGS;
        if(isset($_POST[$APP_ID . '_website_edit']) && $_POST[$APP_ID . '_website_edit'] == 'Edit') {
            state_quick_write("editState", "website"); //Editing website settings
        }
        else if(isset($_POST[$APP_ID . '_website_cancel']) && $_POST[$APP_ID . '_website_cancel'] == 'Cancel') { //Cancel Editing website settings
            state_quick_write("editState", "none"); 
        }
        else if(isset($_POST[$APP_ID . '_website_save']) && $_POST[$APP_ID . '_website_save'] == 'Save') { //Save the new settings
            $_SETTINGS['basic']['title'] = split(' ', $_POST[$APP_ID . '_website_title']);
            $_SETTINGS['basic']['tagline'] = $_POST[$APP_ID . '_website_tagline'];
            $_SETTINGS['basic']['urltype'] = $_POST[$APP_ID . '_website_urltype'];
            
            file_write(WPATH . 'etc' . DS . 'main.yaml', Spyc::YAMLDump($_SETTINGS));
            
            state_quick_write("editState", "none");
        }
        
    }
?>