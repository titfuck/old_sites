<?php
require( '.config.php' );
require( '.mit.php' );

// Lookup by pledge year and number
if( isset( $_REQUEST['y'] ) && isset( $_REQUEST['n'] ) && !isset( $_REQUEST['bro'] ) )
{
	$res = mysql_query( 'SELECT b_uid FROM brothers WHERE b_pledgeyear = \'' . mysql_escape_string( $_REQUEST['y'] ) . '\' AND b_pledgeno = \'' . mysql_escape_string( $_REQUEST['n'] ) . '\'' ) or die( mysql_error( ) );

	if( $resinfo = mysql_fetch_assoc( $res ) )
		$uid = $resinfo['b_uid'];
	else
		die( 'No brother found with that pledge year and number.' );
}
else
{
	$uid = $_REQUEST['bro'];
}

$page_title = 'Brother Profile';
require( '.header.php' );

$res = mysql_query( 'SELECT * FROM brothers WHERE b_uid = \'' . mysql_escape_string( $uid ) . '\'' );
if( !( $binfo = mysql_fetch_assoc( $res ) ) )
	echo '<em>No brother found with that ID number.</em>';
else
{
?>
<img class="imgborder" alt="Portrait" src="/images/brothers/<?php if( '' != $binfo['b_headshot'] ) echo $binfo['b_headshot']; else echo 'hs_none.jpg'; ?>"><br />
Name: <?=$binfo['b_name']?><br />
Status:
<?
switch( $binfo['b_status'] )
{
	case 'ACTIVE':
		echo '<a href="/brotherlist.php?view=active">Active undergraduate brother</a>';
	break;
	case 'PLEDGE':
		echo '<a href="/brotherlist.php?view=pledge">Pledge</a>';
	break;
	case 'ALUM':
		echo '<a href="/brotherlist.php?view=alum">Alumni brother</a>';
	break;
	default:
		echo '<em>Internal error.</em>';
	break;
}
?><br />
<?php
if( '' != $binfo['b_pledgeyear'] )
	echo 'Pledge year: <a href="/brotherlist.php?view=plyr&arg=' . $binfo['b_pledgeyear'] . '">' . $TDC . ' Class of ' . $binfo['b_pledgeyear'] . '</a>';
if( '' != $binfo['b_pledgeno'] )
	echo ' (no. ' . $binfo['b_pledgeno'] . ')';
echo '<br />';
if( '' != $binfo['b_classyear'] )
	echo 'Academic year: <a href="/brotherlist.php?view=clyr&arg=' . $binfo['b_classyear'] . '">MIT Class of ' . $binfo['b_classyear'] . '</a><br />';
if( '' != $binfo['b_hometown'] )
	echo 'Hometown: ' . $binfo['b_hometown'] . '<br />';
if( '' != $binfo['b_major1'] )
{
	echo 'Major(s): ' . $major[$binfo['b_major1']];
	if( '' != $binfo['b_major2'] )
		echo ' <em>and</em> ' . $major[$binfo['b_major2']];
	echo '<br />';
}

echo '<br />' . $binfo['b_blurb'];

}

require( '.footer.php' );
?>
