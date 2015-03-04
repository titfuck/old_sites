<?php
error_reporting( E_ALL );

echo 'thumbs...';
for( $i = 1; $i <= 13; ++$i )
{
	if( !makethumb( './action'.$i.'.jpg', './actionthumb'.$i.'.jpg', 150 ) ) die ( 'error on picture '.$i );
}
die( 'done' );

// function cribbed from php.net comments for imagecopyresampled
function makethumb( $inpath, $outpath, $maxdim )
{
	error_reporting( E_ALL );

	echo 'begin...<br />';
	$src = @imagecreatefromjpeg( $inpath ) or die( 'could not load jpeg' );
	echo 'attempted load<br />';
	if( !$src ) return false;
	$srcw = imagesx( $src );
	$srch = imagesy( $src );
	if ($srcw<$srch) {$height=$maxd;$width=floor($srcw*$height/$srch);}
	else {$width=$maxd;$height=floor($srch*$width/$srcw);}
  if ($width>$srcw && $height>$srch) {$width=$srcw;$height=$srch;}
  $thumb=imagecreatetruecolor($width, $height);
  if ($height<100) {imagecopyresized($thumb, $src, 0, 0, 0, 0, $width, $height, imagesx($src), imagesy($src));}
  else {imagecopyresampled($thumb, $src, 0, 0, 0, 0, $width, $height, imagesx($src), imagesy($src));}
	imagejpeg( $thumb, $outpath );
	return true;
}

?>
