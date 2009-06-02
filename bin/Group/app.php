<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Group extends App {
        private $info;
        private $err;
        
        public function list_view() {
            $APP_ID = $this->APP_ID;
            global $MAIN_URL;
            
            $groups = Groups::ListAll();
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', 'Groups List');
            
            if(count($groups) <= 0) {
                $this->_CONTENT->CEcho('text', "No groups to display!");
            }
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', "<table><tr><td>\n");
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info));
                $this->_CONTENT->CEcho('text', "</td></tr></table>\n");
            }
            
            if(isset($this->err)) {
                $this->_CONTENT->CEcho('text', "<table><tr><td>\n");
                $this->_CONTENT->CEcho('text', Content::GenerateErr($this->err));
                $this->_CONTENT->CEcho('text', "</td></tr></table>\n");
            }
            
            $this->_CONTENT->CEcho('text', Form::Start('createGroup'));
            $this->_CONTENT->CEcho('text', "<table>\n");
            foreach ($groups as $group) {
                $group = $group['groupname'];
                $this->_CONTENT->CEcho('text', "<tr>\n");
                
                $this->_CONTENT->CEcho('text', '<td><a href="' . url_generate($MAIN_URL . '/' . $group) . '">');
                $this->_CONTENT->CEcho('text', $group);
                $this->_CONTENT->CEcho('text', "</a></td>\n");
                
                $this->_CONTENT->CEcho('text', '<td>');
                $this->_CONTENT->CEcho('text', Form::Button($APP_ID . "_" . $group . "_delete", 'Delete', NULL, TRUE));
                $this->_CONTENT->CEcho('text', "</td>\n");
                $this->_CONTENT->CEcho('text', "</tr>\n");
                
            }
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            
            $this->_CONTENT->CEcho('text', '<td style="width: 250px;">');
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_groupname', 'newGroup', NULL, 30));
            $this->_CONTENT->CEcho('text', "</td>\n");
            
            $this->_CONTENT->CEcho('text', '<td>');
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_create', 'Create'));
            $this->_CONTENT->CEcho('text', "</td>\n");
            
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "</table>\n");
            $this->_CONTENT->CEcho('text', Form::End());
        }
        
        public function userlist_view() {
            $APP_ID = $this->APP_ID;
            global $MAIN_URL;
            $params = $this->_APP['parameters'];
            
            if(isset($params['groupName']))
                $users = Groups::ListUsers($params['groupName']);
            else
                $users = array();
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', 'Users List');
            
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', "<table><tr><td>\n");
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info));
                $this->_CONTENT->CEcho('text', "</td></tr></table>\n");
            }
            
            if(isset($this->err)) {
                $this->_CONTENT->CEcho('text', "<table><tr><td>\n");
                $this->_CONTENT->CEcho('text', Content::GenerateErr($this->err));
                $this->_CONTENT->CEcho('text', "</td></tr></table>\n");
            }
            
            $this->_CONTENT->CEcho('text', Form::Start('addUser'));
            $this->_CONTENT->CEcho('text', "<table>\n");
            if(count($users) <= 0) {
                $this->_CONTENT->CEcho('text', "<tr><td>No users to display!</td><td></td></tr>");
            }
            foreach ($users as $user) {
                $user = $user['username'];
                $this->_CONTENT->CEcho('text', "<tr>\n");
                
                $this->_CONTENT->CEcho('text', '<td>');
                $this->_CONTENT->CEcho('text', $user);
                $this->_CONTENT->CEcho('text', "</td>\n");
                
                $this->_CONTENT->CEcho('text', '<td>');
                $this->_CONTENT->CEcho('text', Form::Button($APP_ID . "_" . $user . "_delete", 'Delete', NULL, TRUE));
                $this->_CONTENT->CEcho('text', "</td>\n");
                $this->_CONTENT->CEcho('text', "</tr>\n");
                
            }
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            
            $this->_CONTENT->CEcho('text', '<td style="width: 250px;">');
            $allUsers = Users::ListAll();
            foreach($allUsers as &$allUser) $allUser = $allUser['username'];
            $allUsers2 = $allUsers;
            $this->_CONTENT->CEcho('text', Form::Select($APP_ID . '_username','', NULL, array_combine($allUsers, $allUsers2)));
            $this->_CONTENT->CEcho('text', "</td>\n");
            
            $this->_CONTENT->CEcho('text', '<td>');
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_add', 'Add'));
            $this->_CONTENT->CEcho('text', "</td>\n");
            
            $this->_CONTENT->CEcho('text', "</tr>\n");
            
            $this->_CONTENT->CEcho('text', "</table>\n");
            $this->_CONTENT->CEcho('text', Form::End());
        }
        
        public function create_action() {
            $APP_ID = $this->APP_ID;
            
            if(isset($_POST[$APP_ID . '_create']) && $_POST[$APP_ID . '_create'] == 'Create') {
                if(!Groups::Create($_POST[$APP_ID . '_groupname'])) {
                    global $ERR_MSG;
                    $this->err = 'Cannot Add group!';
                }
                else {
                    $this->info = "Group '" . $_POST[$APP_ID . '_groupname'] . "' was created!";
                }
            }
            else {
                foreach($_POST as $formField => $formData) {
                    if( "Delete" == $formData ) {
                        $user = str_replace($APP_ID . '_', '' , $formField);
                        $user = str_replace("_delete", '', $user);
                        $this->info = "Group '$user' was deleted!";
                        Groups::Delete( $user );
                    }
                }
            }
        }
        
        public function deleteGroup_action() {
            $APP_ID = $this->APP_ID;
            global $MAIN_URL, $SUB_URL;
            $params = $this->_APP['parameters'];
            
            if( isset($_POST[$APP_ID . '_yes']) && $_POST[$APP_ID . '_yes'] == 'Yes' ) {
                if ( isset($params['groupName']) ) {
                    Groups::Delete($params['groupName']);
                    header("Location: " . url_generate($MAIN_URL));
                    die('');
                }
            }
        }
        
        public function userlist_action() {
            $APP_ID = $this->APP_ID;
            global $MAIN_URL, $SUB_URL;
            $params = $this->_APP['parameters'];
            
            if( isset($_POST[$APP_ID . '_add']) && $_POST[$APP_ID . '_add'] == 'Add' ) {
                if ( isset($params['groupName']) ) {
                    
                    if( Groups::AddUser($params['groupName'], $_POST[$APP_ID . '_username'] ) )
                        $this->info = "User '" . $_POST[$APP_ID . '_username'] . "' was added to Group '" . $params['groupName'] . "'!";
                    else
                        $this->err = "Could not add User '" . $_POST[$APP_ID . '_username'] . "' to Group '" . $params['groupName'] . "'!";
                }
            }
            else {
                foreach($_POST as $formField => $formData) {
                    if( "Delete" == $formData ) {
                        $user = str_replace($APP_ID . '_', '' , $formField);
                        $user = str_replace("_delete", '', $user);
                        
                        if( Groups::RemoveUser( $params['groupName'], $user) )
                            $this->info = "User '" . $user . "' was removed from Group '" . $params['groupName'] . "'!";
                        else
                            $this->err = "Could not remove User '" . $user . "' from Group '" . $params['groupName'] . "'!";
                    }
                }
            }
        }
    }
    
?>