<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    function form_select($id, $items, $selectedItem, $class='') {
        $res = '';
        $res .= "<select id=\"$id\" name=\"$id\"";
        if($class != '') $res .= " class=\"$class\"";
        $res .= ">\n";
        foreach($items as $field => $value) {
            if($field == $selectedItem) {
                $res .= "<option value=\"$field\" selected=\"selected\">$value</option>\n";
            }
            else {
                $res .= "<option value=\"$field\">$value</option>\n";
            }
        }
        $res .= "</select>\n";
        $res .= '<script type="text/javascript">' . "\n";
        $res .= "$('#$id').jcombox({ fx: 'slideFade' }); ;\n";
        if($confirm)
            $res .= "$('#link_$id').confirm();" . "\n";
        $res .= '</script>' . "\n";
        return $res;
    }
    
    function form_generate_from_yaml($formYaml, $formValues, $fromName, $prefix) {
        $res = '';
        if(formName != '')
            $res .= form_start($formName);
        
        $res .= "<table>\n";
        
        foreach ( $formYaml as $paramName => $parameter) {
            $res .= "  <tr>\n";
            $res .= "    <th>\n";
            $res .= "$parameter[title]";
            $res .= "    </th>\n";
            $res .= "    <td>\n";
            
            if ( $parameter['type'] == 'text' ) {
                form_text($prefix . $paramName, $formValues[$paramName], '', 50);
            }
            else if ( $parameter['type'] == 'bigtext' ) {
                form_textarea($prefix . $paramName, $formValues[$paramName], '', 50, 5);
            }
            else if ( $parameter['type'] == 'select' ) {
                form_select($prefix . $paramName, $parameter['items'], $formValues[$paramName], '');
            }
            
            $res .= "    </td>\n";
            $res .= "  </tr>\n";
            $res .= "</table>\n";
        }
        
        if(formName != '') 
            $res .= form_end();
        return $res;
    }

    //Sys::includeCSS('jqueryui-contrib');
    //Sys::includeCSS('ui.button');
    Sys::includeCSS('jquery.combox');
    
    Sys::includeJS('jquery');
    Sys::includeJS('jquery-ui');
    //Sys::includeJS('jqueryui-contrib');
    //Sys::includeJS('ui.contrib.js');
    //Sys::includeJS('ui.button.js');
    Sys::includeJS('jquery.onreturn');
    Sys::includeJS('jquery.combox');
    Sys::includeJS('jquery.confirm');
    Sys::includeJS('jquery.jselect');
    
    Class Form {
        private static $_FORM_ID;
        
        public static function Start($id, $action=NULL) {
            Form::$_FORM_ID = $id;
            if(isset($action) && '' != $action)
                return "<form id=\"$id\" method=\"post\" action=\"$action\">\n";
            else
                return "<form id=\"$id\" method=\"post\" action=\"$_SERVER[PHP_SELF]\">\n";
        }
        
        public static function End() {
            Form::$_FORM_ID = NULL;
            return "</form>\n";
        }
        
        public static function Button($id, $value, $class=NULL, $confirm=false, $default=FALSE) {
            $formName = Form::$_FORM_ID;
            $res = "<input type=\"hidden\" id=\"$id\" name=\"$id\" value=\"\" />\n";
            $res .= "<input type=\"button\" id=\"link_$id\" name=\"link_$id\" value=\"$value\"";
            if(isset($class) && '' != $class)
                $res .= " class=\"$class\"";
            else
                $res .= " class=\"ui-button ui-state-default ui-corner-all\"";
            $res .= "></input>\n";
            $res .= '<script type="text/javascript">' . "\n";
            //$res .= "$('#link_$id').click( );\n";
            $res .= "$('#link_$id').click(function() { $('#$id').attr('value', '$value'); $(\"#$formName\").submit();} );\n";
            if(!isset($class))
                $res .= "$('#link_$id').hover(function(){ $(this).addClass(\"ui-state-hover\"); }, function(){ $(this).removeClass(\"ui-state-hover\"); }).mousedown(function(){ $(this).addClass(\"ui-state-active\"); }).mouseup(function(){ $(this).removeClass(\"ui-state-active\");});\n";
            if($confirm)
                $res .= "$('#link_$id').confirm();" . "\n";
            if($default)
                $res .= "$('input', $('#$formName')).onReturn( function() { $('#link_$id').click(); } );\n";
            $res .= '</script>' . "\n";
            return $res;
        }
        
        public static function LinkButton($id, $value, $class=NULL, $confirm=FALSE, $default=FALSE) {
            $formName = Form::$_FORM_ID;
            $res = "<input type=\"hidden\" id=\"$id\" name=\"$id\" value=\"\" />\n";
            $res .= "<a id=\"link_$id\" href=\"#\" class=\"$class\">$value</a>\n";
            $res .= '<script type="text/javascript">' . "\n";
            $res .= "$('#link_$id').click( function() { $('#$id').attr('value', '$value'); $(\"#$formName\").submit();} );\n";
            if($confirm)
                $res .= "$('#link_$id').confirm();" . "\n";
            if($default)
                $res .= "$('input', $('#$formName')).onReturn( function() { $('#link_$id').click(); } );\n";
            $res .= '</script>' . "\n";
            return $res;
        }
        
        public static function Text($id, $value='', $class=NULL, $size=NULL) {
            $formName = Form::$_FORM_ID;
            $res = "<input type=\"text\"";
            if(isset($id) && $id != '') $res .= " id=\"$id\" name=\"$id\"";
            if(isset($value) && $value != '') $res .= " value=\"$value\"";
            if(isset($size) && $size != '') $res .= " size=\"$size\"";
            if(isset($class) && $class != '') 
                $res .= " class=\"$class\"";
            else
                $res .= " class=\"ui-widget ui-widget-content ui-corner-all\"";
            $res .= "></input>\n";
            return $res;
        }
        
        public static function Password($id, $value='', $class=NULL, $size=NULL) {
            $res = "<input type=\"password\"";
            if(isset($id) && $id != '') $res .= " id=\"$id\" name=\"$id\"";
            if(isset($value) && $value != '') $res .= " value=\"$value\"";
            if(isset($size) && $size != '') $res .= " size=\"$size\"";
            if(isset($class) && $class != '') 
                $res .= " class=\"$class\"";
            else
                $res .= " class=\"ui-widget ui-widget-content ui-corner-all\"";
            $res .= "></input>\n";
            return $res;
        }
        
        public static function TextArea($id, $value='', $class=NULL, $cols=NULL, $rows=NULL) {
            $res = "<textarea";
            $res .= " id=\"$id\" name=\"$id\"";
            if(isset($cols)) $res .= " cols=\"$cols\"";
            if(isset($rows)) $res .= " rows=\"$rows\"";
            if(isset($class) && $class != '') 
                $res .= " class=\"$class\"";
            else {
                $res .= " class=\"ui-widget ui-widget-content ui-corner-all\"";
                $res .= " style=\"font-family: Consolas, 'Courier New', mono\"";
            }
            $res .= " wrap=\"off\">\n";
            $res .= "$value";
            $res .= "</textarea>\n";
            return $res;
        }
        
        public static function Select($id, $value, $class=NULL, $items) {
            $res = "<select id=\"$id\" name=\"$id\"";
            if(isset($class) && $class != '') 
                $res .= " class=\"$class\"";
            else
                $res .= " class=\"ui-button ui-state-default ui-corner-all\"";
            $res .= ">\n";
            foreach($items as $field => $val) {
                if($field == $value) {
                    $res .= "<option value=\"$field\" selected=\"selected\">$val</option>\n";
                }
                else {
                    $res .= "<option value=\"$field\">$val</option>\n";
                }
            }
            $res .= "</select>\n";
            
            /*$res .= '<script type="text/javascript">' . "\n";
            //$res .= "$('#$id').jcombox({ fx: 'slideFade' }); ;\n";
            if(!isset($class))
                $res .= "$('#$id').hover(function(){ $(this).addClass(\"ui-state-hover\"); }, function(){ $(this).removeClass(\"ui-state-hover\")});\n";
            $res .= '</script>' . "\n";*/
            return $res;
        }
    }
?>