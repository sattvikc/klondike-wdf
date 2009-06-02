<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Content {
        private $contentCollection; // Holds multiple entries.. like blog posts
        private $data; // Data corresponding to the sub-regions
        private $templateName; // Name of the template to use to generate HTML
        private $subregions; // Mapping between region in app and region in template
        
        public static function GenerateInfo($info, $fixed=FALSE) {
            static $count = 0;
            $count++;
            $res = "<div id=\"info$count\" class=\"ui-state-highlight ui-corner-all\" style=\"padding: 0 .7em;\">\n";
            $res .= "<p><span class=\"ui-icon ui-icon-info\" style=\"float: left; margin-right: .3em;\"></span>\n";
            $res .= $info . "</p>\n";
            $res .= "</div>\n";
            $res .= "<script type=\"text/javascript\">\n";
            $res .= "setTimeout( function() {  $('#info$count').fadeOut('slow', function() { $(this).remove();});}, 3000);\n";
            if($fixed)
                    $res .= "$(function() { $('#info$count').fixedPosition({hpos: 'left', vpos: 'top'})}); \n";
            $res .= "</script>\n";
            return $res;
        }
        
        public static function GenerateErr($err, $fixed=FALSE) {
            static $count = 0;
            $count++;
            $res = "<div id=\"err$count\" class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">\n";
            $res .= "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>\n";
            $res .= $err . "</p>\n";
            $res .= "</div>\n";
            $res .= "<script type=\"text/javascript\">\n";
            $res .= "setTimeout( function() {  $('#err$count').fadeOut('slow', function() { $(this).remove();});}, 3000);\n";
            if($fixed)
                    $res .= "$(function() { $('#err$count').fixedPosition({hpos: 'left', vpos: 'top'})}); \n";
            $res .= "</script>\n";
            return $res;
        }
        
        // Initialize private members
        public function __construct($templateName, $subregions) {
            $this->contentCollection = array();
            $this->templateName = $templateName;
            $this->subregions = $subregions;
        }
        
        public function Clear() {
            $this->contentCollection = array();
        }
        
        // Create new instance of Content
        public function Create() {
            array_push($this->contentCollection, array());
            $this->data = &$this->contentCollection[count($this->contentCollection)-1];
        }
        
        // Print into the current instance of Content
        public function CEcho($region, $text) {
            // Handle missing sub-region
            if ( !isset ( $this->subregions[$region] ) ) 
                $this->subregions[$region] = $region; 
            
            // Print text into appropriate sub-region
            if ( isset($this->data[$this->subregions[$region]]) ) {
                $this->data[$this->subregions[$region]] .= $text;
            }
            else {
                $this->data[$this->subregions[$region]] = $text;
            }
        }
        
        public function __toString() {
            global $CUR_THEME;
            return Template::Render($this->templateName, $this->contentCollection);
        }
    }
    
    class Sys {
        private static $_CSS = array();
        private static $_JS = array();
        
        public static function includeCSS($css) {
            if(!in_array($css, Sys::$_CSS)) {
                Sys::$_CSS[]= $css;
            }
        }
        
        public static function includeJS($js) {
            if(!in_array($js, Sys::$_JS)) {
                Sys::$_JS[]= $js;
            }
        }
        
        public static function LoadHead() {
            foreach(Sys::$_CSS as $css) {
                echo "<link rel=\"stylesheet\" href=\"" . WURL . "lib/css/$css.css\" type=\"text/css\" />\n";
            }
            foreach(Sys::$_JS as $js) {
                echo "<script type=\"text/javascript\" src=\"" . WURL . "lib/js/$js.js\"></script>\n";
            }
        }
    }
?>