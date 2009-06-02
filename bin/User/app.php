<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class User extends App {
        private $info=NULL;
        private $err=NULL;
        
        public function login_view() {
            $APP_ID = $this->APP_ID;
            $params = $this->_APP['parameters'];
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', 'Login');
            
            $this->_CONTENT->CEcho('text', Form::Start('login'));
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info));
            }
            
            if(isset($this->err)) {
                $this->_CONTENT->CEcho('text', Content::GenerateErr($this->err));
            }
            
            if(!Users::$AUTH) {
                $this->_CONTENT->CEcho('text', "<label>Username </label>\n");
                $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_username', '', NULL, 22));
                $this->_CONTENT->CEcho('text', "<br /><label>Password </label>\n");
                $this->_CONTENT->CEcho('text', Form::Password($APP_ID . '_password', '', NULL, 22));
                $this->_CONTENT->CEcho('text', "<br />\n");
                $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_login', "Log-in", NULL, FALSE, TRUE));
            }
            else {
                $this->_CONTENT->CEcho('text', "<table><tr><td>Welcome " . Users::$AUTH_USER . ", ");
                $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_logout', "Logout"));
                $this->_CONTENT->CEcho('text', "</td></tr></table>");
            }
            
            $this->_CONTENT->CEcho('text', Form::End());
        }
        
        public function createUser_view() {
            $APP_ID = $this->APP_ID;
            
            $this->_CONTENT->Create();
            
            $this->_CONTENT->CEcho('title', 'Create User');
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
            $this->_CONTENT->CEcho('text', Form::Start('create_user'));
            $this->_CONTENT->CEcho('text', "<table>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td>Name</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_name', '', NULL, 22));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td>Username</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_username', '', NULL, 22));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td>Password</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Password($APP_ID . '_password', '', NULL, 22));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td>Password (again)</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Password($APP_ID . '_password2', '', NULL, 22));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "<tr>\n");
            $this->_CONTENT->CEcho('text', "<td>E-Mail</td>\n");
            $this->_CONTENT->CEcho('text', "<td>");
            $this->_CONTENT->CEcho('text', Form::Text($APP_ID . '_email', '', NULL, 22));
            $this->_CONTENT->CEcho('text', "</td>\n</tr>\n");
            
            $this->_CONTENT->CEcho('text', "</table>\n");
            $this->_CONTENT->CEcho('text', Form::Button($APP_ID . '_createUser', "Create"));
            $this->_CONTENT->CEcho('text', Form::End());
        }
        
        public function list_view() {
            $APP_ID = $this->APP_ID;
            
            $users = Users::ListAll();
            
            $this->_CONTENT->Create();
            $this->_CONTENT->CEcho('title', 'Users List');
            
            if(isset($this->info)) {
                $this->_CONTENT->CEcho('text', "<table><tr><td>\n");
                $this->_CONTENT->CEcho('text', Content::GenerateInfo($this->info));
                $this->_CONTENT->CEcho('text', "</td></tr></table>\n");
            }
            
            if(count($users) <= 1) {
                $this->_CONTENT->CEcho('text', "No users to display!");
                return;
            }
            
            $this->_CONTENT->CEcho('text', Form::Start('deleteUser'));
            $this->_CONTENT->CEcho('text', "<table>\n");
            foreach ($users as $user) {
                $user = $user['username'];
                if('admin' != $user) {
                    $this->_CONTENT->CEcho('text', "<tr>\n");
                    
                    $this->_CONTENT->CEcho('text', '<td style="width: 250px;">');
                    $this->_CONTENT->CEcho('text', $user);
                    $this->_CONTENT->CEcho('text', "</td>\n");
                    
                    $this->_CONTENT->CEcho('text', '<td>');
                    $this->_CONTENT->CEcho('text', Form::Button($APP_ID . "_" . $user . "_delete", 'Delete', NULL, TRUE));
                    $this->_CONTENT->CEcho('text', "</td>\n");
                    
                    $this->_CONTENT->CEcho('text', "</tr>\n");
                }
            }
            $this->_CONTENT->CEcho('text', "</table>\n");
            $this->_CONTENT->CEcho('text', Form::End());
        }
        
        public function login_action() {
            $APP_ID = $this->APP_ID;
            
            if(isset($_POST[$APP_ID . '_login']) && $_POST[$APP_ID . '_login'] == 'Log-in') {
                if(!Users::Login($_POST[$APP_ID . '_username'], $_POST[$APP_ID . '_password'])) {
                    global $ERR_MSG;
                    $this->err = 'Invalid Username or Password!';
                }
                else {
                    $this->info = "Logged in successfully!";
                }
            }
            else if(isset($_POST[$APP_ID . '_logout']) && $_POST[$APP_ID . '_logout'] == 'Logout') {
                Users::Logout();
                $this->info = "Logged out successfully!";
            }
        }
        
        public function createUser_action() {
            $APP_ID = $this->APP_ID;
            
            if(isset($_POST[$APP_ID . '_createUser']) && $_POST[$APP_ID . '_createUser'] == 'Create') {
                if($_POST[$APP_ID . '_password'] != $_POST[$APP_ID . '_password2']) {
                    global $ERR_MSG;
                    $ERR_MSG = 'Passwords do not match!';
                    return;
                }
                if(Users::Create($_POST[$APP_ID . '_username'], $_POST[$APP_ID . '_password2'], $_POST[$APP_ID . '_name'], $_POST[$APP_ID . '_email']))
                    $this->info = "Created user successfully!";
                else
                    $this->err = "Cannot create User!";
                //Email::Send("admin@sattvik.info", "Sattvik", $_POST[$APP_ID . '_email'], "Thank you", "<html><head><title>Thank you</title></head><body>Please <a href=\"http://localhost/klondike-wdf/\">click here</a> to activate your account.</body></html>");
            }
        }
        
        public function deleteUser_action() {
            $APP_ID = $this->APP_ID;
            global $MAIN_URL, $SUB_URL;
            
            foreach($_POST as $formField => $formData) {
                if( "Delete" == $formData ) {
                    $user = str_replace($APP_ID . '_', '' , $formField);
                    $user = str_replace("_delete", '', $user);
                    
                    Users::Delete( $user );
                    $this->info = " User '$user' has been deleted successfully!";
                }
            }

        }
        
    }
    
?>