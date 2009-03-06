<?php
	function db_fetch_all($query) {
		global $_SETTINGS;
		switch($_SETTINGS['database']['name']) {
		
			case 'mysql' :  mysqldb_fetch_all($query);
						    break;
			
			case 'sqlite' : sqlite_fetch_all($query);
							break;
							
			case 'postgresql' : postgredb_fetch_all($query);
								break;
		
			default : echo " unknown format";
	    }
	}
	
?>