<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    function is_assoc($var)
    {
        return is_array($var) && array_diff_key($var,array_keys(array_keys($var)));
    }
    
    class Yaml {
        public static function Load($fileName) {
            
        }
        
        public static function Dump($data) {
            return Yaml::RecursiveDump($data);
        }
        
        private static function RecursiveDump($data, $indent=0) {
            $result = ;
            
        }
        
        private static function CreateIndent($indent) {
            $result = '';
            for($i=0; $i<$indent; $i++) {
                $result .= ' ';
            }
            return $result;
        }
    }
?>