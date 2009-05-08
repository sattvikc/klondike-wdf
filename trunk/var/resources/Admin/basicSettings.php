<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
                        <h2>Website</h2>
<?php
    if($editState == "website") {
?>
                        <?php form_start('basicSettings'); ?>
                        <table cellspacing="0" cellpadding="2" class="list">
                            <tr>
                                <td class="field">Title</td>
                                <td class="value"><?php form_text($APP_ID . '_website_title', join(" ", $_SETTINGS['basic']['title']), 'text', '50'); ?></td>
                            </tr>
                            <tr>
                                <td class="field">Tagline</td>
                                <td class="value"><?php form_text($APP_ID . '_website_tagline', $_SETTINGS['basic']['tagline'], 'text', '50'); ?></td>
                            </tr>
                            <tr>
                                <td class="field">URL Type</td>
                                <td class="value">
                                    <?php form_select($APP_ID . '_website_urltype', array('noht' => 'No HTACCESS', 'ht' => 'Use HTACCESS'), $_SETTINGS['basic']['urltype'], 'text'); ?>
                                </td>
                            </tr>
                        </table>
                        <p>
                            <?php form_link_button($APP_ID . '_website_save', 'Save', 'basicSettings', ''); ?>
                            <?php form_link_button($APP_ID . '_website_cancel', 'Cancel', 'basicSettings', ''); ?>
                        </p>
                        <?php form_end(); ?>
<?php
    }
    else {
?>
                        <?php form_start('basicSettings'); ?>
                        <table cellspacing="0" cellpadding="2" class="list">
                            <tr>
                                <td class="field">Title</td>
                                <td class="value"><?php echo join(" ", $_SETTINGS['basic']['title']); ?></td>
                            </tr>
                            <tr>
                                <td class="field">Tagline</td>
                                <td class="value"><?php echo $_SETTINGS['basic']['tagline']; ?></td>
                            </tr>
                            <tr>
                                <td class="field">URL Type</td>
                                <td class="value"><?php $urlTypes = array('noht' => 'No HTACCESS', 'ht' => 'Use HTACCESS'); echo $urlTypes[$_SETTINGS['basic']['urltype']]; ?></td>
                            </tr>
                        </table>
                        <p>
                            <?php form_link_button($APP_ID . '_website_edit', 'Edit', 'basicSettings', ''); ?>
                        </p>
                        <?php form_end(); ?>
<?php
    }
?>
