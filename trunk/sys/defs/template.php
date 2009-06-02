<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Template {
        public static $CURRENT; // Stores instance of the current template generator
        
        // Calls appropriate generator functions on the template generator
        public static function Render($templateName, $contentCollection) { 
            $result = '';
            $result .= call_user_func_array(array(Template::$CURRENT, $templateName . 'Start'), array());
            foreach($contentCollection as $content) {
                $result .= call_user_func(array(Template::$CURRENT, $templateName), $content);
            }
            $result .= call_user_func(array(Template::$CURRENT, $templateName . 'End'));
            return $result;
        }
        
        // This function is used to conviniently generate HTML that match the template
        public static function RenderTemplate($fileName, $content) { 
            $subject = file_read($fileName); // Reads the template file
            $pattern = '/\{\[([a-zA-Z0-9_]*)\]\}/'; // Regular Expression to match the template variables in the format {[varname]}
            preg_match_all($pattern, $subject, $matches); // Execute the regular expression to find the variables
            
            // Replace variables from $content array on template Variables
            for($i=0; $i<count($matches[0]); $i++) {
                if( isset ($content[$matches[1][$i]] ) ) {
                    $subject = str_replace($matches[0][$i], $content[$matches[1][$i]], $subject);
                }
                else {
                    $subject = str_replace($matches[0][$i], '', $subject);
                }
            }
            
            return $subject;
        }
    }
?>