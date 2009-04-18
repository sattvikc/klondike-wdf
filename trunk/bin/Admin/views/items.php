<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_items_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS;
        echo '                        <div id="items">' . "\n";
        foreach($params['items'] as $item) {
?>
                            <table>
                                <tr>
                                    <td rowspan="2" class="icon"><img src="<?php echo WURL; ?>/share/resources/admin/<?php echo $item['icon']; ?>" /></td>
                                    <td class="itemTitle"><a href="<?php echo url_generate($item['url']);?>"><?php echo $item['title']; ?></a></td>
                                </tr>
                                <tr>
                                    <td class="itemDescription"><?php echo $item['description']; ?></td>
                                </tr>
                            </table>
<?php
        }
        echo '                        </div>' . "\n";
    }
?>