<?php
$page_title = 'Log In';
require( '.header.php' );
?>
<h3>Please provide your email address and password.</h3>

<table>
<tr><td>Email</td><td><input type="text" name="tdclogin_email" /></td></tr>
<tr><td>Password</td><td><input type="text" name="tdclogin_pass" /></td></tr>
<tr><td></td><td><input type="submit" value="Log In" /></td></tr>
</table>

<br />
Have you <a href="/forgotpass.php">forgotten your password</a>?

<?php require( '.footer.php' ); ?>
