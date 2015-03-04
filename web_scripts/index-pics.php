<?php
$page_title = 'News &amp; Events';
require( '.header.php' );
?>
<h3>Rush <?=$TDC?> 2008!</h3>
<p>
Are you looking for TDC's Fall 2008 rush schedule?  <a href="/rush.php">It's now available online!</a>
</p>
<h3>Please excuse our dust!</h3>
<p>
We're currently renovating our website.  Please excuse any broken links, glitches, or missing information.  If you have any questions, please feel free to contact us.
</p>

<script type="text/javascript" src="/scripts/shadowbox-2.0.js"></script>
<script type="text/javascript" src="/scripts/shadowbox-skin/skin.js"></script>
<link rel="stylesheet" href="/scripts/shadowbox-skin/skin.css" type="text/css" />
<script type="text/javascript">
//Shadowbox.loadSkin('classic', 'scripts/shadowbox-skin');
window.onload = Shadowbox.init;
</script>

<?php
$shadowbox_rel = "shadowbox[ActionShots];options={continuous:true,animSequence:'sync'}";

$captions[1] = "Armand '10 and Brock '08 on the beach";
$captions[2] = "Brothers at the 2007 Fall Formal";
$captions[3] = "Armand '10 in Peru";
$captions[4] = "Up, up, and away";
$captions[5] = "Paul Sierra '05 gets ready to skydive";
$captions[6] = "Mingling before the 2008 Spring Formal";
$captions[7] = "Pledge class of 2010 performs";
$captions[8] = "Gaston '10 entertains his girlfriend";
$captions[9] = "Brothers attend the Convention of Theta Delta Chi";
$captions[10] = "Brothers go out for dinner";
$captions[11] = "Dancing on the roofdeck during Rush 2007";
$captions[12] = "Spreading the love during Rush 2007";
$captions[13] = "Women in togas invade Rob 2010's room";

for( $i = 1; $i <= 14; ++$i )
{
?>
<a href="/images/action/action<?=$i?>.jpg" rel="<?=$shadowbox_rel?>" title="<?=$captions[$i]?>">Open photo <?=$i?></a>
<?php
}
?>

<?php require( '.footer.php' ); ?>
