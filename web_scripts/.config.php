<?php

ini_set('display_errors', '1');
error_reporting( 'E_ALL' );

$TDC = '&Theta;&Delta;&Chi;';
$TD_TDC = '&Theta;<sup>&Delta;</sup> ' . $TDC;

$IMG_PATH = '/images/';
$MYSQL_HOST = 'sql.mit.edu';
$MYSQL_PORT = 3306;
$MYSQL_USER = 'kelleyk';
$MYSQL_PASS = 'qeh84wiq';
$MYSQL_DATA = 'kelleyk+tdcwebsite';
$PASS_SALT = 't4DC4#_s';

if( !mysql_connect( $MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS ) ) die( 'Error connecting to SQL server.' );
if( !mysql_select_db( $MYSQL_DATA ) ) die( 'Error selecting database.' );

function mysql_query_w( $sql, $err )
{
	$result = @mysql_query( $sql ) or die( 'Fatal error: ' . $err );
	return $result;
}

?>
