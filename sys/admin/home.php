                        <h1>Home</h1>
                        <p>Welcome to the DashBoard. Pick an item to manage.</p>
                        <div id="items">
                            <table>
                                <tr>
                                    <td rowspan="2" class="icon"><img src="<?php echo WURL; ?>/share/resources/admin/settings.png" /></td>
                                    <td class="itemTitle"><a href="<?php echo url_generate('admin/basic');?>">Basic Settings</a></td>
                                </tr>
                                <tr>
                                    <td class="itemDescription">Change the settings related to your installation.</td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td rowspan="2" class="icon"><img src="<?php echo WURL; ?>/share/resources/admin/pages.png" /></td>
                                    <td class="itemTitle"><a href="<?php echo url_generate('admin/pages');?>">Pages</a></td>
                                </tr>
                                <tr>
                                    <td class="itemDescription">Manage pages of your website.</td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td rowspan="2" class="icon"><img src="<?php echo WURL; ?>/share/resources/admin/users.png" /></td>
                                    <td class="itemTitle"><a href="<?php echo url_generate('admin/membership');?>">Membership and Roles</a></td>
                                </tr>
                                <tr>
                                    <td class="itemDescription">Manage users and access control.</td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td rowspan="2" class="icon"><img src="<?php echo WURL; ?>/share/resources/admin/package.png" /></td>
                                    <td class="itemTitle"><a href="<?php echo url_generate('admin/packages');?>">Package Manager</a></td>
                                </tr>
                                <tr>
                                    <td class="itemDescription">Install/Uninstall Addons for the framework.</td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td rowspan="2" class="icon"><img src="<?php echo WURL; ?>/share/resources/admin/develop.png" /></td>
                                    <td class="itemTitle"><a href="<?php echo url_generate('admin/develop');?>">Develop</a></td>
                                </tr>
                                <tr>
                                    <td class="itemDescription">Develop addons for the framework.</td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td rowspan="2" class="icon"><img src="<?php echo WURL; ?>/share/resources/admin/info.png" /></td>
                                    <td class="itemTitle"><a href="<?php echo url_generate('admin/information');?>">Information</a></td>
                                </tr>
                                <tr>
                                    <td class="itemDescription">System Information</td>
                                </tr>
                            </table>
                        </div>
