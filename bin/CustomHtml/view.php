<?php

    function CustomHtml_default_view($title, $text) {
        
        $result = '';
        $result .=  "<?xml version=\"1.0\" ?>\n";
        $result .=  "<contents>\n";
        $result .=  "<content>\n";
        $result .=  "<title>" . $title ."</title>\n";
        $result .=  "<text><![CDATA[\n";
        $result .=  $text . "\n";
        $result .=  "]]</text>\n";
        $result .=  "</content>\n";
        $result .=  "</contents>\n";
        
        return $result;
    }
    
?>
