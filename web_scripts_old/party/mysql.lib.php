<?php

require_once('joe.lib.php');

function DBMaster($sql) {
	sessTime($sql);
	$res = mysql_query($sql);
	sessTime();
	return $res;
}
function DBSlave($sql) {
	sessTime($sql);
	$res = mysql_query($sql);
	sessTime();
	if (mysql_error()) trigger_error($sql."<br />\n".mysql_error(),E_USER_ERROR);
	return $res;
}

function DBSelect($sql) { return DBSlave($sql); }
function DBInsert($sql) {
	DBMaster($sql);
	if (mysql_error()) trigger_error($sql."<br />\n".mysql_error(),E_USER_ERROR);
	return mysql_insert_id();
}
function DBUpdate($sql) { DBInsert($sql); }
function DBDelete($sql) { DBInsert($sql); }
function DBCreate($sql) { DBMaster($sql); }
function DBDrop($sql) { DBMaster($sql); }
function DBGrant($sql) { DBInsert($sql); }
function DBRevoke($sql) { DBInsert($sql); }
function DBSet($sql) { DBInsert($sql); }
function DBShow($sql) { return DBSlave($sql); }

function calcDBSize($tdb) {
	$sql_result = "SHOW DATABASES LIKE '".mysql_escape_string($tdb)."'";
	$result = DBShow($sql_result);
	if (!mysql_num_rows($result)) return null;
	
   $sql_result = "SHOW TABLE STATUS FROM `" .mysql_escape_string($tdb)."`";
   $result = DBShow($sql_result);

   if($result) {
       $size = 0;
       while ($data = mysql_fetch_array($result)) {
             $size += $data["Data_length"] + $data["Index_length"];
       }
       mysql_free_result($result);
       return $size;
   }
   else {
       return null;
   }
}

?>
