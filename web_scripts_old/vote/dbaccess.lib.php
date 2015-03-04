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

function checkQuotas($userId=null) {
	if (empty($userId)) {
		$sql = 'SELECT DatabaseId,Name FROM DB WHERE bEnabled=1';
	} else {
		$sql = sprintf("SELECT DB.DatabaseId,Name FROM DB INNER JOIN DBOwner ON DB.DatabaseId = DBOwner.DatabaseId WHERE bEnabled=1 AND UserId = '%s'", mysql_escape_string($userId));
	}
	$databases = fetchRows(DBSelect($sql),'Name');
	foreach($databases as $db) {
		$DBId = $db['DatabaseId'];
		$arr['dLastCheck'] = 'NOW()';
		$arr['nBytes'] = calcDBSize($db['Name']);
		$sql = sprintf("UPDATE DB %s WHERE DatabaseId = '%s'",
						buildSQLSet($arr),
						mysql_escape_string($DBId));
		DBUpdate($sql);
	}
	$sql = "UPDATE UserStat SET nBytes = (
				SELECT SUM(nBytes)
				FROM DB
				INNER JOIN DBOwner ON DBOwner.DatabaseId = DB.DatabaseId
				WHERE DBOwner.UserId = UserStat.UserId
				  AND DB.bEnabled=1
				GROUP BY UserId
				), dLastCheck = NOW()";
	if (!empty($userId)) $sql .= sprintf(" WHERE UserId = '%s'", mysql_escape_string($userId));
	DBUpdate($sql);
	$sql = "UPDATE UserStat SET nDatabases = (
				SELECT COUNT(*)
				FROM DB
				INNER JOIN DBOwner ON DBOwner.DatabaseId = DB.DatabaseId
				WHERE DBOwner.UserId = UserStat.UserId
				  AND DB.bEnabled=1
				GROUP BY UserId
				), dLastCheck = NOW()";
	if (!empty($userId)) $sql .= sprintf(" WHERE UserId = '%s'", mysql_escape_string($userId));
	DBUpdate($sql);
}

?>
