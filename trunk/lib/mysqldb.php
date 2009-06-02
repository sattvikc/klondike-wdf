<?php if(!defined('KLONDIKE_VER')) die("Access denied! Are you trying to hack???"); ?>
<?php
    class MySQLdb {
        public static function Select($fields, $tableName, $condition='', $order='', $limitLow=-1, $limitHigh=-1) {
            global $_SETTINGS;
            
            $query = "SELECT ";
            if(is_array($fields))
                $query .= implode(',', $fields);
            else
                $query .= $fields;
            $query .= " FROM " . $_SETTINGS['database']['prefix'] . $tableName;
            if('' != $condition)
                $query .= " WHERE " . $condition;
            if('' != $order)
                $query .= " ORDER BY " . $order;
            if((-1 != $limitLow) && (-1 != $limitHigh))
                $query .= " LIMIT " . $limitLow . "," . $limitHigh;
            $query .= ";";
            
            $result = array();
            $db = mysql_connect($_SETTINGS['database']['host'], $_SETTINGS['database']['user'], $_SETTINGS['database']['pass']) or die ('Cannot connect to MySQL!');
            mysql_select_db( $_SETTINGS['database']['name'] ) or die ("Cannot select database!");
            
            $res = mysql_query($query) or "<return>";
            if("<return>" == $res) return false;
            
            while ($row = mysql_fetch_assoc($res)) {
                array_push($result, $row);
            }
            
            mysql_free_result($res);
            mysql_close();
            
            return $result;
        }
        
        public static function Insert($tableName, $fields, $values) {
            global $_SETTINGS;
            
            $query = "INSERT INTO " . $_SETTINGS['database']['prefix'] . $tableName;
            if(is_array($fields))
                $query .= "(" . implode(",", $fields) . ")";
            else
                $query .= "(" . $fields . ")";
            $query .= " VALUES (";
            $query .= implode(",", $values);
            $query .= ");";
            
            $db = mysql_connect($_SETTINGS['database']['host'], $_SETTINGS['database']['user'], $_SETTINGS['database']['pass']) or die ('Cannot connect to MySQL!');
            mysql_select_db( $_SETTINGS['database']['name'] ) or die ("Cannot select database!");
            
            $res = mysql_query($query);
            mysql_close($db);
            
            return $res;
        }
        
        public static function Update($tableName, $updates, $condition) {
            global $_SETTINGS;
            
            $query = "UPDATE " . $_SETTINGS['database']['prefix'] . $tableName;
            $query .= " SET " . $updates;
            $query .= " WHERE " . $condition;
            $query .= ";";
            
            $db = mysql_connect($_SETTINGS['database']['host'], $_SETTINGS['database']['user'], $_SETTINGS['database']['pass']) or die ('Cannot connect to MySQL!');
            mysql_select_db( $_SETTINGS['database']['name'] ) or die ("Cannot select database!");
            
            $res = mysql_query($query) or "<return>";
            if("<return>" == $res) return false;
            $result = mysql_affected_rows();
            mysql_close($db);
            
            return $result;
        }
        
        public static function Delete($tableName, $condition) {
            global $_SETTINGS;
            
            $query = "DELETE FROM " . $_SETTINGS['database']['prefix'] . $tableName;
            $query .= " WHERE " . $condition;
            $query .= ";";
            
            $db = mysql_connect($_SETTINGS['database']['host'], $_SETTINGS['database']['user'], $_SETTINGS['database']['pass']) or die ('Cannot connect to MySQL!');
            mysql_select_db( $_SETTINGS['database']['name'] ) or die ("Cannot select database!");
            
            $res = mysql_query($query);
            mysql_close($db);
            
            return $res;
        }
    }
?>
