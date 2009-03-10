<?php
		function user_create($username,$password) {
			global $_SETTINGS;
			session_start();
			if(isset($_SESSION['user']))
				return FALSE;
			$time=time();
			$time_pass=md5($time);
			$enc_pass=md5($password.$time_pass);
			$_SESSION['user']=$username;
			$_SESSION['password']=$enc_pass;
			$query = "Insert into $_SETTINGS['database']['name']['table'](username,password) values($_SESSION ['user'],$_SESSION['password'])"; // just a dummy no such table exists
			db_fetch_all(query);
			session_unset();
			session_destroy();
			
		}
?>
