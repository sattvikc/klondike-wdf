<?php
	   function sqlitedb_fetch_all($query) {
		global $_SETTINGS;
		$result = array();
		$db = sqlite_open('$_SETTINGS['database']['path']');
		 if($res=sqlite_query($db,$query)) {
			while($r = sqlite_fetch_array($res)) {
			array_push($result,$r);
			}
			sqlite_close($db);
			return $result;
		 }
           }

		
		
		
		function sqlitedb_update_all($query) {
		   global $_SETTINGS;
		   $res = array();
		   $db = sqlite_open('$_SETTINGS['database']['path']');
		     if($res=sqlite_query($db,$query)) {
			  return sqlite_changes($db);
	    	     }
		sqlite_close($db);
		}
?>
