<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_items_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS;
        
        content_start();
        content_echo($subregions['title'], '');
        content_echo($subregions['text'], '<div id="items">' . "\n");
        foreach($params['items'] as $item) {
            content_echo($subregions['text'], "<table>\n");
            content_echo($subregions['text'], "<tr>\n");
            content_echo($subregions['text'], "<td rowspan=\"2\" class=\"icon\"><img src=\"" . WURL . "/share/resources/admin/$item[icon]\" /></td>\n");
            content_echo($subregions['text'], "<td class=\"itemTitle\"><a href=\"" . url_generate($item['url']) . "\">$item[title]</a></td>\n");
            content_echo($subregions['text'], "</tr>\n");
            content_echo($subregions['text'], "<tr>\n");
            content_echo($subregions['text'], "<td class=\"itemDescription\">$item[description]</td>\n");
            content_echo($subregions['text'], "</tr>\n");
            content_echo($subregions['text'], "</table>\n");
        }
        content_echo($subregions['text'], '</div>' . "\n");
        content_end();
    }
?>