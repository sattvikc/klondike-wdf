<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function form_start($formName) {
        return "<form name=\"$formName\" method=\"post\" action=\"$_SERVER[PHP_SELF]\">\n";
    }
    
    function form_end() {
        return "</form>\n";
    }
    
    function form_button($id, $text, $class='') {
        return "<input type=\"submit\" id=\"$id\" name=\"$id\" class=\"$class\" value=\"$text\" />\n";
    }

    function form_link_button($id, $text, $formName, $class='') {
        $res = '';
        $res .= "<input type=\"hidden\" id=\"$id\" name=\"$id\" value=\"\" />\n";
        $res .= "<a href=\"#\" class=\"$class\" onClick=\"$('#$id').attr('value', '$text'); document.$formName.submit();\" >$text</a>\n";
        return $res;
    }
    
    function form_text($id, $text, $class='', $size='') {
        $res = '';
        $res .= "<input type=\"text\"";
        if($id != '') $res .= " id=\"$id\" name=\"$id\"";
        if($text != '') $res .= " value=\"$text\"";
        if($size != '') $res .= " size=\"$size\"";
        if($class != '') $res .= " class=\"$class\"";
        $res .= " />\n";
        return $res;
    }
    
    function form_password($id, $text, $class='', $size='') {
        $res = '';
        $res .= "<input type=\"password\"";
        if($id != '') $res .= " id=\"$id\" name=\"$id\"";
        if($text != '') $res .= " value=\"$text\"";
        if($size != '') $res .= " size=\"$size\"";
        if($class != '') $res .= " class=\"$class\"";
        $res .= " />\n";
        return $res;
    }
    
    function form_textarea($id, $text, $class='', $cols='', $rows='') {
        $res = '';
        $res .= "<textarea";
        if($id != '') $res .= " id=\"$id\" name=\"$id\"";
        if($cols != '') $res .= " size=\"$cols\"";
        if($rows != '') $res .= " size=\"$rows\"";
        if($class != '') $res .= " class=\"$class\"";
        $res .= ">\n";
        if($text != '') $res .= "$text";
        $res .= "</textarea>\n";
        return $res;
    }
    
    function form_select($id, $items, $selectedItem, $class='') {
        $res = '';
        $res .= "<select id=\"$id\" name=\"$id\" selectzor=\"1\"";
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
?>