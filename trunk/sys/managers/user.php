<?php
		function user_create($username,$password) {
			global $_SETTINGS;
			
			if($query=db_fetch_all("select * from $_SETTINGS['database']['prefix']users where username='$username'"))
				return FALSE;
			$time=md5(time());
			$password=$time.$password;
			$enc_pass=$time.":".$password;
			$query = "Insert into $_SETTINGS['database']['prefix']users(username,password) values($username,$enc_pass)"; 
			
			db_update_all($query);
			
			
		}
		
		function user_delete($username,$password) {
			global $_SETTINGS;
			if(!($query=db_fetch_all("select * from $_SETTINGS['database']['prefix']users where username='$username'")))
				return FALSE;
				
				$query="Delete from $_SETTINGS['database']['prefix']users where username='$username'";
				db_update_all($query);
				
		}
		
		function user_change_password($username,$password,$new_pass)	{
			global $_SETTINGS;
			if(!($query=db_fetch_all("select * from $_SETTINGS['database']['prefix']users where username='$username'")))
				return FALSE;
				
			$time=md5(time());
			$new_pass=$time.$new_pass;
			$enc_pass=$time.":".$new_pass;
			$query = "Update $_SETTINGS['database']['prefix']users Set password='$enc_pass' where username='$username'"; 
			db_update_all($query);
		
		}
		
		function user_authenticate($username,$password) {
			global $_SETTINGS;
			if(!($query=db_fetch_all("select * from $_SETTINGS['database']['prefix']users where username='$username'")))
				return FALSE;
			
			$enc_pass=db_fetch_all("select password from $_SETTINGS['database']['prefix']users where username='$username'");
			$check= split(":",$enc_pass);
			$time=$check[0];
			$password=$time.$password;
			$password=md5($password);
			if($password!=$check[1])
				return FALSE;
			$_SESSION['authenticated']="YES";
			$_SESSION['authenticated_user']="$username";
			
		}	
			

			
?>
