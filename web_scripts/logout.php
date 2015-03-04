<?php

setcookie('tdc_user','');
setcookie('tdc_pass','');

if( !isset( $_REQUEST['ref'] ) )
	header( 'Location: /index.php' );
else
	header( 'Location: ' . $_REQUEST['ref'] );

?>
