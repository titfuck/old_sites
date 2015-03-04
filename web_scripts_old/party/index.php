<?php
require_once('party.lib.php');

import_request_variables('gpc','i_');

$s = "select * from parties where subdate(dstart,interval 6 hour)<now() and adddate(dend,interval 6 hour) > now() order by dstart desc limit 1";
//$s = "select * from parties order by dstart desc limit 1";
$r = fetchRows(DBSelect($s),'partyid');
if (count($r)) {
	$thisParty = array_shift($r);
	$thisPartyID = $thisParty['partyid'];
	$thisPartyName = $thisParty['partyname'];
	$thisPartyPop = $thisParty['partypop'];
} else {
	die('no parties happening.');
}

/*
$s = sprintf("select count(*) from visitors where partyid='%s'",mysql_escape_string($thisPartyID));
$r = array_shift(fetchRows(DBSelect($s)));
if (count($r)) {
	$thisPartyPop = array_shift($r);
	$s = sprintf("update parties set partypop = '%s' where partyid = '%s'",
			mysql_escape_string($thisPartyPop),
			mysql_escape_string($thisPartyID));
	DBUpdate($s);
} else {
	$thisPartyPop = 0;
}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>tdc party desk</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link href="css/css.css" media="screen" rel="Stylesheet" type="text/css" />
  <?/*
  <script type="text/javascript" language="javascript">
  <!--
  	var partyID = <?=$thisPartyID?>;
  -->
  </script>
  */?>
  <script src="js/prototype.js?<?=rand()?>" type="text/javascript"></script>
  <script src="js/party.js?<?=rand()?>" type="text/javascript"></script>
<? /*
  <script src="js/effects.js" type="text/javascript"></script>
  <script src="js/dragdrop.js" type="text/javascript"></script>
  <script src="js/controls.js" type="text/javascript"></script>
  <style type="text/css">
    div.auto_complete {
      position:absolute;
      width:250px;
      background-color:white;
      border:1px solid #888;
      margin:0px;
      padding:0px;
    }
    ul.contacts  {
      list-style-type: none;
      margin:0px;
      padding:0px;
    }
    ul.contacts li.selected { background-color: #ffb; }
    li.contact {
      list-style-type: none;
      display:block;
      margin:0;
      padding:2px;
      height:32px;
    }
    li.contact div.image {
      float:left;
      width:32px;
      height:32px;
      margin-right:8px;
    }
    li.contact div.name {
      font-weight:bold;
      font-size:12px;
      line-height:1.2em;
    }
    li.contact div.email {
      font-size:10px;
      color:#888;
    }
    #list {
      margin:0;
      margin-top:10px;
      padding:0;
      list-style-type: none;
      width:250px;
    }
    #list li {
      margin:0;
      margin-bottom:4px;
      padding:5px;
      border:1px solid #888;
      cursor:move;
    }
  </style>
*/ ?>
</head>
<body onLoad="$('in[name]').focus()">

  <div id="header">
  	<p><h1>theta delta chi</h1></p>
  </div><!-- header -->
  
  <div id="content">


<form method="post" id="checkin" name="checkin" onSubmit="return ajaxcall(Form.serialize('checkin'));">
	<input type="hidden" name="partyID" id="partyID" value="<?=$thisPartyID?>" />

<div id="checkin">
  <h1>tdc party: desk check in</h1>
  <table><tr><td>
  <div style="width:80px;">name:</div>
  <input autocomplete="off" id="in[name]" name="in[name]" size="30" type="text" value="" />
  </td><td>
  <div style="width:80px;">age:</div>
  <input autocomplete="off" id="in[age]" name="in[age]" size="3" type="text" value="" />
  </td></tr><tr><td>
  <div style="width:80px;">home/school:</div>
  <input autocomplete="off" id="in[home]" name="in[home]" size="30" type="text" value="" />
  </td><td>
  <div style="width:80px;">email:</div>
  <input autocomplete="off" id="in[email]" name="in[email]" size="30" type="text" value="" />
  </td></tr><tr><td colspan=2>
  <input type="submit" value="check in" onClick="ajaxcall(Form.serialize('checkin')); Form.disable('checkin');">
  </td></tr></table>
</div>

<div id="population" style="display: none;">
	<h1>tdc party: population</h1>
	<table><tr><td>
	inside:
	</td><td>
	<input size="3" type="text" id="partyPop" name="partyPop" value="<?=$thisPartyPop?>" readonly=readonly/>
	</td></tr><tr><td>
	adjust:
	</td><td>
	<input type="button" value="-1" onClick="javascript:popAdjust(-1)" />
	<input type="button" value="-5" onClick="javascript:popAdjust(-5)" />
	<input type="button" value="-10" onClick="javascript:popAdjust(-10)" />
	<input type="button" value="+5" onClick="javascript:popAdjust(5)" />
	<input type="button" value="+10" onClick="javascript:popAdjust(10)" />
	</td></tr></table>
</div>

<div id="partyinfo">
	<h1>tdc party: info</h1>
	<table><tr><td>
	name:
	</td><td>
	<?=$thisParty['partyname']?>
	</td></tr><tr><td>
	start:
	</td><td>
	<?=$thisParty['dstart']?>
	</td></tr><tr><td>
	end:
	</td><td>
	<?=$thisParty['dend']?>
	</td></tr></table>
</div>

<input type=button id="poptog" style="width: 25px; height: 25px; bottom: 5px; right: 5px; position: absolute; border: 1px solid #fff; background-color: #fff;" />
<script>
<!--
Event.observe('poptog', 'click', function x(){Element.toggle($('population'));}, true);
-->
</script>
</form>
</div><!-- content -->
  
</body>
</html>
