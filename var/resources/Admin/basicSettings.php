<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
                        <h2>Website</h2>
<?php
    if($editState == "website") {
?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                        <table cellspacing="0" cellpadding="2" class="list">
                            <tr>
                                <td class="field">Title</td>
                                <td class="value"><input name="<?php echo $APP_ID . '_'; ?>website_title" id="<?php echo $APP_ID . '_'; ?>website_title" type="text" value="<?php echo join(" ", $_SETTINGS['basic']['title']); ?>" class="ui-state-active ui-corner-all" /></td>
                            </tr>
                            <tr>
                                <td class="field">Tagline</td>
                                <td class="value"><input name="<?php echo $APP_ID . '_'; ?>website_tagline" id="<?php echo $APP_ID . '_'; ?>website_tagline" type="text" value="<?php echo $_SETTINGS['basic']['tagline']; ?>" class="ui-state-active ui-corner-all" /></td>
                            </tr>
                            <tr>
                                <td class="field">URL Type</td>
                                <td class="value"><input name="<?php echo $APP_ID . '_'; ?>website_urltype" id="<?php echo $APP_ID . '_'; ?>website_urltype" type="text" value="<?php echo $_SETTINGS['basic']['urltype']; ?>" class="ui-state-active ui-corner-all" /></td>
                            </tr>
                        </table>
                        <p>
                            <input name="<?php echo $APP_ID . '_'; ?>website_save" id="<?php echo $APP_ID . '_'; ?>website_save" type="submit" value="Save" class="ui-state-default ui-corner-all" />
                            <input name="<?php echo $APP_ID . '_'; ?>website_cancel" id="<?php echo $APP_ID . '_'; ?>website_cancel" type="submit" value="Cancel" class="ui-state-default ui-corner-all" />
                        </p>
                        </form>
<?php
    }
    else {
?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
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
                                <td class="value"><?php echo $_SETTINGS['basic']['urltype']; ?></td>
                            </tr>
                        </table>
                        <p>
                            <input name="<?php echo $APP_ID . '_'; ?>website" id="<?php echo $APP_ID . '_'; ?>website" type="submit" value="Edit" class="ui-state-default ui-corner-all" />
                        </p>
                        </form>
<?php
    }
?>
