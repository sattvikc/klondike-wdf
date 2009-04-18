<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function form_start($formName) {
        echo "<form name=\"$formName\" method=\"post\" action=\"$_SERVER[PHP_SELF]\">\n";
    }
    
    function form_end() {
        echo "</form>\n";
    }
    
    function form_button($id, $text, $class) {
        echo "<input type=\"submit\" id=\"$id\" name=\"$id\" class=\"$class\" value=\"$text\" />\n";
    }
    
    function form_text($id, $text, $class, $size) {
        echo "<input type=\"text\"";
        if($id != '') echo " id=\"$id\" name=\"$id\"";
        if($text != '') echo " value=\"$text\"";
        if($size != '') echo " size=\"$size\"";
        if($class != '') echo " class=\"$class\"";
        echo " />\n";
    }
    
    function form_select($id, $items, $selectedItem, $class) {
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
?>