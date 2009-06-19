<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php

    Sys::includeCSS('jquery.easywidgets');
    Sys::includeJS('jquery.easywidgets');
    Sys::includeJS('jquery.fixedposition');
    
    class Pages extends App {
        private $info;
        private $err;
        
        //Views
        public function list_view() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'views' . DS . 'list.php';
        }
        
        public function mapping_view() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'views' . DS . 'mapping.php';
        }
        
        public function basicEdit_view() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'views' . DS . 'basicEdit.php';
        }
        
        public function inheritanceEdit_view() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'views' . DS . 'inheritanceEdit.php';
        }
        
        public function appEdit_view() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'views' . DS . 'appEdit.php';
        }
        
        public function newApp_view() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'views' . DS . 'newApp.php';
        }
        
        //Controllers
        public function list_action() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'actions' . DS . 'list.php';
        }
        
        public function mapping_action() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'actions' . DS . 'mapping.php';
        }
        
        public function basicEdit_action() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'actions' . DS . 'basicEdit.php';
        }
        
        public function inheritanceEdit_action() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'actions' . DS . 'inheritanceEdit.php';
        }
        
        public function appEdit_action() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'actions' . DS . 'appEdit.php';
        }
        
        public function newApp_action() {
            require WPATH . 'bin' . DS . 'Pages' . DS . 'actions' . DS . 'newApp.php';
        }
    }
    
?>