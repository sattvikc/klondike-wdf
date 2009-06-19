<?php

    class Database {
        public static $EXECUTER = NULL;
        
        public function Select($fields, $tableName, $condition='', $order='', $limitLow=-1, $limitHigh=-1) {
            global $_SETTINGS;
            
            if(!isset(Database::$EXECUTER)) return FALSE;
            
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
            
            $result = Database::$EXECUTER->Select($query);
            
            return $result;
        }
        
        public function Insert($tableName, $fields, $values) {
            global $_SETTINGS;
            
            if(!isset(Database::$EXECUTER)) return FALSE;
            
            $query = "INSERT INTO " . $_SETTINGS['database']['prefix'] . $tableName;
            if(is_array($fields))
                $query .= "(" . implode(",", $fields) . ")";
            else
                $query .= "(" . $fields . ")";
            $query .= " VALUES (";
            $query .= implode(",", $values);
            $query .= ");";
            
            $result = Database::$EXECUTER->Insert($query);
            
            return $result;
        }
        
        public function Update($tableName, $updates, $condition) {
            global $_SETTINGS;
            
            if(!isset(Database::$EXECUTER)) return FALSE;
            
            $query = "UPDATE " . $_SETTINGS['database']['prefix'] . $tableName;
            $query .= " SET " . $updates;
            $query .= " WHERE " . $condition;
            $query .= ";";
            
            $result = Database::$EXECUTER->Update($query);
            
            return $result;
        }
        
        public function Delete($tableName, $condition) {
            global $_SETTINGS;
            
            if(!isset(Database::$EXECUTER)) return FALSE;
            
            $query = "DELETE FROM " . $_SETTINGS['database']['prefix'] . $tableName;
            $query .= " WHERE " . $condition;
            $query .= ";";
            
            $result = Database::$EXECUTER->Delete($query);
            
            return $result;
        }
    }
    
    if('mysql' == $_SETTINGS['database']['db']) Database::$EXECUTER = new MySQLdb;
    if('sqlite' == $_SETTINGS['database']['db']) Database::$EXECUTER = new SQLitedb;
?>
