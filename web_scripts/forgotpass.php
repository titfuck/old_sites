<?php

function gen_rand_str( $i_len )
{
	$chars = 'ABCDEFGHKLMNPQRSTUVWXYZ23456789';
	$gen = '';

	for( $i = 0; $i < $i_len; ++$i )
		$gen .= $chars[ rand( 0, strlen( $chars ) - 1 ) ];

	return $gen;
}

if( isset( $_REQUEST['tdclogin_act'] ) )
{
	require_once( '.config.php' );
	
	$esc_email = mysql_escape_string( $_REQUEST['tdclogin_email'] );
	$res = mysql_query_w( 'SELECT b_uid, b_name, b_email FROM brothers WHERE b_email=\'' . $esc_email . '\'' );
	if( !( $binfo = mysql_fetch_assoc( $res ) ) )
	{
		die( 'No account was found with that email address.' );
	}

	$resetcode = gen_rand_str( 10 );

	mysql_query_w( 'UPDATE brothers SET b_resetcode = \'' . $resetcode . '\' WHERE b_uid = ' . $binfo['b_uid'] );

	$msg = $binfo['b_name'] . ",\n\nA password reset request has been submitted for your TDC account.  Please visit the following URL:\n\nhttp://tdc.mit.edu/resetpass.php\n\nYour reset code is: " . $resetcode . "\n\nIf you have any questions, please contact the Network Geek.";

	mail( $binfo['b_email'], 'Forgotten TDC password', $msg );

	die('Please check your email.  You have been sent instructions on resetting your password.');
}

$page_title = 'Forgotten Password';
require( '.header.php' );
?>
<h3>Please provide your email address.</h3>

<form method="post" action="/forgotpass.php">
<table>
<tr><td>Email</td><td><input type="text" name="tdclogin_email" /></td></tr>
<tr><td></td><td><input type="submit" name="tdclogin_act" value="Reset" /></td></tr>
</table>
</form>

<?php require( '.footer.php' ); ?>
