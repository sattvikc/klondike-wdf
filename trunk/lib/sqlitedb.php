<?php if(!defined('KLONDIKE_VER')) die("Access denied! Are you trying to hack???"); ?>
<?php
    class SQLitedb {
        public function Select($query) {
            global $_SETTINGS;
            
            $result = array();
            echo WPATH . 'var' . DS . $_SETTINGS['database']['name'] . '.db';
            $db = sqlite_open(WPATH . 'var' . DS . $_SETTINGS['database']['name'] . '.db');
            $res=sqlite_query($db, $query) or die("cant query");
             while($row = sqlite_fetch_array($res)) {
                 array_push($result, $row);
            }
            sqlite_close();
            
            return $result;
        }
        
     public function Insert($query) {
            global $_SETTINGS;
            
            $db = sqlite_open(WPATH . 'var' . DS . $_SETTINGS['database']['name'] . '.db');
            $res = sqlite_query($query) or die ("Can't insert!");
            $result = sqlite_changes($db);
            sqlite_close($db);
            
            return $result;
        }
        
        public function Update($query) {
            global $_SETTINGS;
            
            $db = sqlite_open(WPATH . 'var' . DS . $_SETTINGS['database']['name'] . '.db');
            $res = sqlite_query($query) or die ("Can't update!");
            $result = sqlite_changes($db);
            sqlite_close($db);
            
            return $result;
        }
        
        public function Delete($query) {
            global $_SETTINGS;
            
            $db = sqlite_open(WPATH . 'var' . DS . $_SETTINGS['database']['name'] . '.db');
            $res = sqlite_query($query) or die ("Can't delete!");
            $result = sqlite_changes($db);
            sqlite_close($db);
            
            return $result;
        }
    }
?>
