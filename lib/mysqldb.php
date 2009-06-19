<?php if(!defined('KLONDIKE_VER')) die("Access denied! Are you trying to hack???"); ?>
<?php
    class MySQLdb {
        public function __construct() {
            global $_SETTINGS;
            
            $db = mysql_connect($_SETTINGS['database']['host'], $_SETTINGS['database']['user'], $_SETTINGS['database']['pass']) or die ('Cannot connect to MySQL!');
            mysql_select_db( $_SETTINGS['database']['name'] ) or die ("Cannot select database!");
        }
        
        public function __destruct() {
            mysql_close();
        }
        
        public function Select($query) {
            global $_SETTINGS;
            
            $result = array();
            
            $res = mysql_query($query) or "<return>";
            if("<return>" == $res) return false;
            
            while ($row = mysql_fetch_assoc($res)) {
                array_push($result, $row);
            }
            
            mysql_free_result($res);
            
            return $result;
        }
        
        public function Insert($query) {
            global $_SETTINGS;
            
            $res = mysql_query($query);
            
            return $res;
        }
        
        public function Update($query) {
            global $_SETTINGS;
            
            $res = mysql_query($query) or "<return>";
            if("<return>" == $res) return false;
            $result = mysql_affected_rows();
            
            return $result;
        }
        
        public function Delete($query) {
            global $_SETTINGS;
            
            $res = mysql_query($query);
            
            return $res;
        }
    }
    
?>
