<!-- top.php -->
<!--
Expects $page_id to be set for navbar link highlighting.
Optional: Set $page_title for a nicely formatted title in the titlebar.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <META http-equiv="Content-Style-Type" content="text/css">
  <meta http-equiv="X-UA-Compatible" content="IE=8">
  <link rel="stylesheet" type="text/css" media="screen,print" href="/tdc/reset.css">
  <link rel="stylesheet" type="text/css" media="screen,print" href="/tdc/base.css">
  <!-- set $page_title to display a title string. -->
  <title><?php if (isset($page_title)) {print("$page_title - ");} ?>Theta Deuteron of Theta Delta Chi</title>
</head>
<body class="<?php print $page_id;?>">
  <div id="page">
    <?php require_once('/mit/tdc/web_scripts/tdc/header.php'); ?>
    <div id="body"> 
<!-- Tags closed by footer.php -->
