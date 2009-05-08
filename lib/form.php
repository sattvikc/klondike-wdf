<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function form_start($formName) {
        echo "<form name=\"$formName\" method=\"post\" action=\"$_SERVER[PHP_SELF]\">\n";
    }
    
    function form_end() {
        echo "</form>\n";
    }
    
    function form_button($id, $text, $class='') {
        echo "<input type=\"submit\" id=\"$id\" name=\"$id\" class=\"$class\" value=\"$text\" />\n";
    }

    function form_link_button($id, $text, $formName, $class='') {
        echo "<input type=\"hidden\" id=\"$id\" name=\"$id\" value=\"\" />\n";
        echo "<a href=\"#\" class=\"$class\" onClick=\"$('#$id').attr('value', '$text'); document.$formName.submit();\" >$text</a>\n";
    }
    
    function form_text($id, $text, $class='', $size='') {
        echo "<input type=\"text\"";
        if($id != '') echo " id=\"$id\" name=\"$id\"";
        if($text != '') echo " value=\"$text\"";
        if($size != '') echo " size=\"$size\"";
        if($class != '') echo " class=\"$class\"";
        echo " />\n";
    }
    
    function form_password($id, $text, $class='', $size='') {
        echo "<input type=\"password\"";
        if($id != '') echo " id=\"$id\" name=\"$id\"";
        if($text != '') echo " value=\"$text\"";
        if($size != '') echo " size=\"$size\"";
        if($class != '') echo " class=\"$class\"";
        echo " />\n";
    }
    
    function form_textarea($id, $text, $class='', $cols='', $rows='') {
        echo "<textarea";
        if($id != '') echo " id=\"$id\" name=\"$id\"";
        if($cols != '') echo " size=\"$cols\"";
        if($rows != '') echo " size=\"$rows\"";
        if($class != '') echo " class=\"$class\"";
        echo ">\n";
        if($text != '') echo "$text";
        echo "</textarea>\n";
    }
    
    function form_select($id, $items, $selectedItem, $class='') {
        echo "<select id=\"$id\" name=\"$id\" selectzor=\"1\"";
        if($class != '') echo " class=\"$class\"";
        echo ">\n";
        foreach($items as $field => $value) {
            if($field == $selectedItem) {
                echo "<option value=\"$field\" selected=\"selected\">$value</option>\n";
            }
            else {
                echo "<option value=\"$field\">$value</option>\n";
            }
        }
        echo "</select>\n";
    }
    
    function form_generate_from_yaml($formYaml, $formValues, $fromName, $prefix) {
        if(formName != '') 
            form_start($formName);
        
        echo "<table>\n";
        
        foreach ( $formYaml as $paramName => $parameter) {
            echo "  <tr>\n";
            echo "    <th>\n";
            echo "$parameter[title]";
            echo "    </th>\n";
            echo "    <td>\n";
            
            if ( $parameter['type'] == 'text' ) {
                form_text($prefix . $paramName, $formValues[$paramName], '', 50);
            }
            else if ( $parameter['type'] == 'bigtext' ) {
                form_textarea($prefix . $paramName, $formValues[$paramName], '', 50, 5);
            }
            else if ( $parameter['type'] == 'select' ) {
                form_select($prefix . $paramName, $parameter['items'], $formValues[$paramName], '');
            }
            
            echo "    </td>\n";
            echo "  </tr>\n";
            echo "</table>\n";
        }
        
        if(formName != '') 
            form_end();
    }
?>