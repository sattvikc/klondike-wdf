<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    class Widget {
        protected $output;
        protected $attributes;
        protected $data;
        protected $_TAG;
        
        public function __construct($tagName, $attributes=array()) {
            $this->_TAG = $tagName;
            $this->output = "";
            $this->attributes = $attributes;
        }
        
        public function getAttribute($attributeName) {
            if(!isset($this->attributes[$attributeName])) return NULL;
            return $this->attributes[$attributeName];
        }
        
        public function setAttribute($attributeName, $value) {
            $this->attributes[$attributeName] = $value;
        }
        
        public function setData($data) {
            $this->data = $data;
        }
        
        public function generateHTML() {
            $this->output = "<" . $this->_TAG . " ";
            foreach($this->attributes as $attribute=>$value){
                $this->output.=$attribute.'="'.$value.'" ';
            }
            
            if(isset($this->data)) {
                $this->output=substr_replace($this->output,">\n",-1);
                $this->processData($this->data);
                $this->output .= "</" . $this->_TAG . ">\n";
            }
            else {
                $this->output=substr_replace($this->output,"/>\n",-1);
            }
            return $this->output;
        }
        
        protected function processData($data) {
            if(is_array($data)) {
                foreach($data as $item) { $this->processData($item); }
            }
            else if($data instanceof Widget) {
                $this->output .= $data->generateHTML();
            }
            else {
                $this->output .= (string)$data;
            }
        }
    }

?>