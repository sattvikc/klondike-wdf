<?php
		function user_create($username,$password) {
			global $_SETTINGS;
			
			if($query=mysql_query("select * from $_SETTINGS['database']['name']['table'] where username='$username'"))
				return FALSE;
			$time=md5(time());
			$password=$time.$password;
			$enc_pass=$time.":".$password;
			$query = "Insert into $_SETTINGS['database']['name']['table'](username,password) values($username,$enc_pass)"; // just a dummy no such table exists
			$query=mysql_real_escape_string($query);
			db_update_all($query);
			session_unset();
			session_destroy();
			
		}
		
		function user_delete($username,$password) {
?>
