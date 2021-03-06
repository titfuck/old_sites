<?php

if( isset( $_REQUEST['tdcreset_act'] ) )
{
	$email = mysql_escape_string( $_REQUEST['tdcreset_email'] );
	$code = mysql_escape_string( $_REQUEST['tdcreset_resetcode'] );
	$newpass = $_REQUEST['tdcreset_newpass'];
	$confirm = $_REQUEST['tdcreset_confirm'];

	if( !$email || !$code || !$newpass || !$confirm )
		die( 'Please fill out all fields.' );

	if( $newpass != $confirm )
		die( 'You must enter the same password twice.' );

	require_once( '.config.php' );
	
	$res = mysql_query_w( 'SELECT b_uid, b_resetcode FROM brothers WHERE b_email=\'' . $email . '\'' );
	if( !( $binfo = mysql_fetch_assoc( $res ) ) )
		die( 'No account was found with that email address.' );

	if( $code != $binfo['b_resetcode'] )
		die( 'That reset code is invalid.  If you have requested multiple reset codes, only the most recent one is valid.' );

	$newhash = sha1( $PASS_HASH . $newpass );
	
/*

	$resetcode = gen_rand_str( 10 );

	mysql_query_w( 'UPDATE brothers SET b_resetcode = \'' . $resetcode . '\' WHERE b_uid = ' . $binfo['b_uid'] );

	$msg = $binfo['b_name'] . ",\n\nA password reset request has been submitted for your TDC account.  Please visit the following URL:\n\nhttp://tdc.mit.edu/resetpass.php\n\nYour reset code is: " . $resetcode . "\n\nIf you have any questions, please contact the Network Geek.";

	mail( $binfo['b_email'], 'Forgotten TDC password', $msg );

	die('Please check your email.  You have been sent instructions on resetting your password.');
*/
}

$page_title = 'Reset Password';
require( '.header.php' );
?>
<h3>Please set a new password.</h3>

<form method="post" action="/forgotpass.php">
<table>
<tr><td>Email</td><td><input type="text" name="tdcreset_email" /></td></tr>
<tr><td>Reset Code</td><td><input type="text" name="tdcreset_resetcode" /></td></tr>
<tr><td>New Password</td><td><input type="password" name="tdcreset_newpass" /></td></tr>
<tr><td>Confirm Password</td><td><input type="password" name="tdcreset_confirm" /></td></tr>
<tr><td></td><td><input type="submit" name="tdcreset_act" value="Reset" /></td></tr>
</table>
</form>

<?php require( '.footer.php' ); ?>
