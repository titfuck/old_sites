<?php

function bro( $yr, $no )
{
	return '<a href="/brotherhood.php?m=d&y=' . $yr . '&n=' . $no . '">';
}

$page_title = 'Contact Us';
require( '.header.php' );

ini_set('error_reporting', E_ALL);
?>

<table>
<tr><td>President</td><td><?=bro(2009,1)?>Alberto Mena</a></td></tr>
<tr><td>House Manager</td><td>LeVon Thomas</td></tr>
<tr><td>House Manager</td><td>James "Shuyi" Chen</td></tr>
<tr><td>Recording Secretary</td><td><?=bro(2010,8)?>Gaston de Zarraga</a></td></tr>
<tr><td>Corresponding Secretary</td><td><?=bro(2010,8)?>Gaston de Zarraga</a></td></tr>
<tr><td>Herald</td><td><?=bro(2010,1)?>Adam Blakeway</a></td></tr>
<tr><td>Sargeant-at-Arms</td><td>Joseph Presbrey</td></tr>
<tr><td>Senior Executive</td><td>Brock Forrest</td></tr>
<tr><td>Junior Executive</td><td>Emanual Borja</td></tr>
<tr><td>Treasurer</td><td><?=bro(2009,4)?>Emanuel Borja</a></td></tr>
<tr><td>Rush Chair</td><td><?=bro(2010,1)?>Adam Blakeway</a></td></tr>
<tr><td>Rush Chair</td><td><?=bro(2009,6)?>Samuel Phillips</a></td></tr>
<tr><td>Pledge Trainer</td><td>Christian Rodriguez</td></tr>
<tr><td>Steward</td><td><?=bro(2010,3)?>Christopher Compean</a></td></tr>
<tr><td>Historian</td><td><?=bro(2010,12)?>Joseph Diaz</td></tr>
<tr><td>Social Chair</td><td><?=bro(2010,14)?>Kevin Kelley</a></td></tr>
<tr><td>Social Chair</td><td><?=bro(2010,2)?>Armand Mignot</a></td></tr>
<tr><td>Network Geek</td><td><?=bro(2010,14)?>Kevin Kelley</a></td></tr>
</table>

<?php require( '.footer.php' ); ?>
