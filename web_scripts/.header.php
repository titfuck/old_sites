<?
ini_set('error_reporting', E_ALL);

function bro_link( $yr, $no )
{
        return '<a href="/profile.php?y=' . $yr . '&n=' . $no . '">';
}

require_once( '.config.php' ); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Theta Deuteron of Theta Delta Chi</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<style type="text/css">
html,body{margin:0;padding:0}
body{font: 76% arial,sans-serif; background:#04529D}
p{margin:0 10px 10px}
a{display:block;color: #981793;padding:10px}
div#content p{line-height:1.4}
div#content{background:#FFFFFF}
div#logobox{background:#04529D;color:#FFFFFF}
div#extra{background:#04529D;text-align:center}
div#extra a{color:#FFFFFF;margin:0;padding:0;text-decoration:none}
div#footer{background: #CCCCCC;color: #000000;}
div#footer p{margin:0;padding:5px 10px}

div#wrapper{float:right;width:100%;margin-left:-200px}
div#content{margin-left:168px;padding-left:7px}
div#topbar{margin-left:168px;background:#04529D;padding-top:7px;padding-bottom:3px;}
div#logobox{float:left;width:168px;text-align:center}
div#extra{float:left;clear:left;width:168px;padding-top:20px}
div#footer{clear:both;width:100%;font-size:8pt;text-align:center}

div#content{min-height:500px;border-style:solid;border-width:1px 0 0 1px;border-color: #000000}
div#footer{border-style:solid;border-width:1px 0 1px 0;border-color: #000000}

div#content{padding-top:10px}

div#content p{text-indent:2em}

div#content a{margin:0;padding:0;display:inline;}

div.pend{text-align:center;margin-top:5px;margin-bottom:5px;clear:both}

span#motto{font-style:italic}

div#content h2{margin:2px}
div#content h3{margin:2px;padding-top:10px}

.officertable {border-collapse:collapse;border-top:1px solid black;}
.officertable tr{border-bottom:1px solid black;}
.officertable td{padding:2px}
.otrow0 {background-color:#CCCCCC}
.otcol0 {width:250px}

.imgborder {
	border:1px solid #555555;
	margin:0; padding:0;
}
.imgwrap {
	border:1px solid #555555;
	padding:5px; margin: 5px; padding-bottom:2px;
	background-color:#BBBBBB;
}

.headthumb {
	border:1px solid #333333;
}

.brotherlist_info {
	width:225px;
}

.rushschedule {
	width: 500px;
	border-top:1px solid black;
}

.rushevtname {
	font-weight:bold;
}
.rushevttime {
	text-align:right;
	font-weight:bold;
}
.rushevtdesc {
	text-align:justify;
	padding-bottom:5px;
}

.contentfoot
{
}

<?php
if( isset( $_REQUEST['x'] ) && $_REQUEST['x'] != 'kevin' )
{
?>
.rushletter { display:none; }
<?php
} else {
?>

.rushscheddiv {
	float:left;
	display:block;
}
.rushletter {
	float:left;

}

<?php } ?>

</style>
</head>
<body<?php if(isset($body_prop)) echo $body_prop; ?>>
<div id="container">
	<div id="wrapper">
		<div id="topbar">
			<img src="<?=$IMG_PATH?>name.png" alt="Theta Deuteron of Theta Delta Chi" />
		</div>
                <div id="content">
			<h2><?php echo $page_title; ?></h2>
