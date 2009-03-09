<?php if(!defined('KLONDIKE_VER')) die("Access denied! Are you trying to hack???"); ?>
<?php
    function mysqldb_fetch_all($query) {
        global $_SETTINGS;
        $result = array();
        $db = mysql_connect($_SETTINGS['database']['host'], $_SETTINGS['database']['user'], $_SETTINGS['database']['pass']) or die ('Cannot connect to MySQL!');
        mysql_select_db( $_SETTINGS['database']['name'] ) or die ("Cannot select database!");
        $res = mysql_query($query) or die ("Can't query database!");
        while ($row = mysql_fetch_assoc($res)) {
            array_push($result, $row);
        }
        mysql_free_result($res);
        mysql_close();
        return $result;
    }

    function mysqldb_insert($query) {
        global $_SETTINGS;
        $db = mysql_connect($_SETTINGS['database']['host'], $_SETTINGS['database']['user'], $_SETTINGS['database']['pass']) or die ('Cannot connect to MySQL!');
        mysql_select_db( $_SETTINGS['database']['name'] ) or die ("Cannot select database!");
        $res = mysql_query($query) or die ("Can't insert/delete!");
        mysql_close($db);
        return mysql_affected_rows();
    }
?>