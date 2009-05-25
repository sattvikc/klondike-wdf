<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    function Admin_pageBasicEdit_view($params, $subregions) {
        global $_CUR_REGION, $_SETTINGS, $MAIN_URL, $APP_ID, $SUB_URL;
        
        if(count($SUB_URL) == 2 && $SUB_URL[1] == 'edit') {
            $pgYaml = yaml_load(WPATH . 'etc' . DS . 'pages' . DS . $SUB_URL[0], true);
            echo form_start('basicEdit');
            
            $theme_list = array('default' => 'Default Theme');
            $themes = dir_get_dirs(WPATH . 'share' . DS . 'themes');
            foreach ($themes as $theme) {
                $theme_list[$theme] = $theme;
            }
?>
                        <table cellspacing="0" cellpadding="2" class="list">
                            <tr>
                                <td class="field">Title</td>
                                <td class="value"><?php echo form_text($APP_ID . '_title', $pgYaml['title'], 'text', 50); ?></td>
                            </tr>
                            <tr>
                                <td class="field">Type</td>
                                <td class="value"><?php echo form_select($APP_ID . '_type', array('page' => 'Page', 'api' => 'API'), $pgYaml['type'], 'text'); ?></td>
                            </tr>
                            <tr>
                                <td class="field">Theme</td>
                                <td class="value"><?php echo form_select($APP_ID . '_theme', $theme_list, $pgYaml['theme'], 'text'); ?></td>
                            </tr>
                            <tr>
                                <td class="field">Inherit Start</td>
                                <td class="value"><?php echo form_text($APP_ID . '_inheritStart', join(',', $pgYaml['inherit']['start']), 'text', 50); ?></td>
                            </tr>
                            <tr>
                                <td class="field">Inherit End</td>
                                <td class="value"><?php echo form_text($APP_ID . '_inheritEnd', join(',', $pgYaml['inherit']['end']), 'text', 50); ?></td>
                            </tr>
                        </table>
<?php
            echo form_link_button($APP_ID . '_save', 'Save', 'basicEdit','');
            echo form_end();
        }
    }
?>