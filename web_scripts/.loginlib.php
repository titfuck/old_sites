<?php

$pass = 'foobar';
$hashedpass = sha1( $pass );

echo $hashedpass;
echo '<br />';
echo strlen( $hashedpass );

?>
