<?php
$page_title = 'Our Brotherhood';
require( '.header.php' );
require_once( '.mit.php' );

function is_intlike( $s )
{
	return is_numeric($s) && floatval($s) == intval(floatval($s));
}

if( 'rev' == $_REQUEST['ord'] )
	$sort_reverse = true;

$query_arg = mysql_escape_string( $_REQUEST['arg'] );
$errflag = false;

$lim_clause = 'LIMIT 18';

switch( $_REQUEST['view'] )
{
default:
	$where_clause = 'WHERE (b_status = \'PLEDGE\' OR b_status = \'ACTIVE\')';
	$sort_clause = 'ORDER BY b_name ASC';
	$title = 'Undergraduate Brothers and Pledges';
	$lim_clause = '';
break;
case 'pledge':
	$where_clause = 'WHERE b_status = \'PLEDGE\'';
	$sort_clause = 'ORDER BY b_name ASC';
	$title = 'Pledges';
	$lim_clause = '';
break;
case 'active':
	$where_clause = 'WHERE b_status = \'ACTIVE\'';
	$sort_clause = 'ORDER BY b_name ASC';
	$title = 'Undergraduate Brothers';
	$lim_clause = '';
break;
case 'alum':
	$where_clause = 'WHERE b_status = \'ALUM\'';
	$sort_clause = 'ORDER BY b_name ASC';
	$title = 'Alumni Brothers';
	// TODO: very temporary... need paging mechanism!
	$lim_clause = '';
break;
case 'plyr':
	$where_clause = 'WHERE b_pledgeyear = ' . $query_arg;
	$sort_clause = 'ORDER BY b_pledgeno ASC';
	$title = $TDC . ' Class of ' . $query_arg;
	if( !is_intlike( $query_arg ) ) $errflag = true;
break;
case 'clyr':
	$where_clause = 'WHERE b_classyear = ' . $query_arg;
	$sort_clause = 'ORDER BY b_pledgeyear ASC, b_pledgeno ASC';
	$title = 'MIT Class of ' . $query_arg;
	if( !is_intlike( $query_arg ) ) $errflag = true;
break;
case 'major':
	$where_clause = 'WHERE (b_major1 = '.$query_arg.') OR (b_major2 = '.$query_arg.') OR (b_minor1 = '.$query_arg.') OR (b_minor2 = '.$query_arg.')';
	$sort_clause = 'ORDER BY b_name DESC';
	if( !is_defined( $major[$query_arg] ) )
		$errflag = true;
	else
		$title = 'Brothers In Course ' . $query_arg . ' (' . $major[$query_arg] . ')';
break;
}

switch( $_REQUEST['sort'] )
{
case 'name':
	$sort_clause = 'ORDER BY b_name DESC';
break;
case 'name_rev':
	$sort_clause = 'ORDER BY b_name ASC';
break;
}

if( true == $errflag )
{
	echo 'Error: invalid input.';
}
else
{

$res = mysql_query_w( 'SELECT * FROM brothers ' . $where_clause . ' ' . $sort_clause . ' ' . $lim_clause );
echo '<h2>' . $title . '</h2>';
?>
<table class="brotherlist">
<?php

function make_bro_entry( $binfo )
{
	global $major;
	global $TDC;
        echo '<td><a href="/profile.php?bro=' . $binfo['b_uid'] . '"><img class="headthumb" src="/images/brothers/' . ( '' != $binfo['b_headthumb'] ? $binfo['b_headthumb'] : 'hsthumb_none.jpg' ) . '" /></a></td><td class="brotherlist_info"><a href="/profile.php?bro=' . $binfo['b_uid'] . '">' . $binfo['b_name'];
        echo ' ' . $binfo[ 'b_classyear' ] . '</a><br />';
        echo $TDC . ' Class of ' . $binfo['b_pledgeyear'] . ( 0 < $binfo['b_pledgeno'] ? ' (no. ' . $binfo['b_pledgeno'] . ')' : '' ) . '<br />';
        echo $major[$binfo['b_major1']];
	if( '' != $binfo['b_major2'] ) echo ' <em>and</em> ' . $major[$binfo['b_major2']];
        echo '</td>';
}

$i = 0;
while( $binfo = mysql_fetch_assoc( $res ) )
{
	if( 0 == ( $i % 3 ) )
	{
		if( 0 != $i ) echo '</tr>';
		echo '<tr>';
	}
	make_bro_entry( $binfo );
	++$i;
}

if( 0 == $i )
	echo '<em>No brothers meet that search critera.</em>';
else
	echo '</tr>';
?>
</table>
<?php
}
require( '.footer.php' );
?>
