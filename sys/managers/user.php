<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    
    class Users {
        public static $AUTH;
        public static $AUTH_USER;
        
        public static function Create($username, $password, $name, $email) {
            global $_SETTINGS;
            
            $username = addslashes($username);
            $password = addslashes($password);
            $name = addslashes($name);
            $email = addslashes($email);
            
            $query=MySQLdb::Select('*', 'users', "username='$username'");
            if(count($query) > 0)
                return FALSE;
            $time = md5(time());
            $password = $time.$password;
            $enc_pass = $time . ":" . md5($password);
            return MySQLdb::Insert('users', "username,password,name,email,createdOn", array("'$username'", "'$enc_pass'", "'$name'", "'$email'", "NOW()"));
        }
        
        public static function Login($username, $password) {
            $username = addslashes($username);
            $password = addslashes($password);
            
            $query=MySQLdb::Select("*", "users", "username='$username'");
            
            if(count($query) == 0)
                return FALSE;
            
            $enc_pass = $query[0]['password'];
            $check = split(":",$enc_pass);
            $time = $check[0];
            $password = $time.$password;
            $password = md5($password);
            if($password != $check[1])
                return FALSE;
            $ip = $_SERVER['REMOTE_ADDR'];
            MySQLdb::Update("users", "lastLoggedInOn=NOW(), lastLoginIP='$ip'", "username='$username'");
            $_SESSION['auth'] = TRUE;
            $_SESSION['auth_user'] = $username;
            Users::$AUTH = TRUE;
            Users::$AUTH_USER = $_SESSION['auth_user'];
            
            return TRUE;
        }
        
        public static function Logout() {
            unset($_SESSION['auth']);
            unset($_SESSION['auth_user']);
            Users::$AUTH = FALSE;
            Users::$AUTH_USER = 'anonymus';
        }
        
        public static function ListAll() {
            return MySQLdb::Select("username", "users");
        }
        
        public static function Delete($username) {
            $username = addslashes($username);
            return MySQLdb::Delete('users', "username='$username'");
        }
        
        public static function ChangePassword($username, $oldPassword, $newPassword) {
            $username = addslashes($username);
            $oldPassword = addslashes($oldPassword);
            $newPassword = addslashes($newPassword);
            
            $query=MySQLdb::Select("*", "users", "username='$username'");
            
            if(count($query) == 0)
                return FALSE;
            
            $enc_pass = $query[0]['password'];
            $check = split(":",$enc_pass);
            $time = $check[0];
            $oldPassword = $time.$oldPassword;
            $oldPassword = md5($oldPassword);
            if($oldPassword == $check[1]) {
                $time = md5(time());
                $newPassword = $time . $newPassword;
                $enc_pass = $time . ":" . md5($newPassword);
                
                MySQLdb::Update('users', "password='$enc_pass'", "username='$username'");
                return TRUE;
            }
            return FALSE;
        }
    }
    
    if ( isset( $_SESSION['auth'] ) ) {
        Users::$AUTH = TRUE;
        Users::$AUTH_USER = $_SESSION['auth_user'];
    }
    else {
        Users::$AUTH = FALSE;
        Users::$AUTH_USER = 'anonymus';
    }
?>
