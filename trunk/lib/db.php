<?php
    function db_fetch_all($query) {
        global $_SETTINGS;
        switch($_SETTINGS['database']['db']) {
        
            case 'mysql' :  return mysqldb_fetch_all($query);
                            break;
            
            case 'sqlite' : return sqlite_fetch_all($query);
                            break;
                            
            case 'postgresql' : return postgredb_fetch_all($query);
                                break;
        
            default : echo "unknown format";
        }
    }
    
    function db_update_all($query) {
        global $_SETTINGS;
        if($_SETTINGS['database']['db']=="mysql")    {
            mysqldb_update_all($query);
        }
        else if($_SETTINGS['database']['name']=="sqlite") {
            sqlitedb_update_all($query);
        }
    }

?>
