<?php

	include('common.php');

	$id1 = alphanumeric($_REQUEST['id1']);
	$id2 = alphanumeric($_REQUEST['id2']);

	$x11 = numeric($_REQUEST['x11']);
	$x12 = numeric($_REQUEST['x12']);
	$x13 = numeric($_REQUEST['x13']);
	$x14 = numeric($_REQUEST['x14']);
	$y11 = numeric($_REQUEST['y11']);
	$y12 = numeric($_REQUEST['y12']);
	$y13 = numeric($_REQUEST['y13']);
	$y14 = numeric($_REQUEST['y14']);

	$x21 = numeric($_REQUEST['x21']);
	$x22 = numeric($_REQUEST['x22']);
	$x23 = numeric($_REQUEST['x23']);
	$x24 = numeric($_REQUEST['x24']);
	$y21 = numeric($_REQUEST['y21']);
	$y22 = numeric($_REQUEST['y22']);
	$y23 = numeric($_REQUEST['y23']);
	$y24 = numeric($_REQUEST['y24']);

	$o1 = load_image_data($id1);
	$o2 = load_image_data($id2);

	$w1 = $o1['width'];
	$h1 = $o1['height'];
	$w2 = $o2['width'];
	$h2 = $o2['height'];

	$o1["links"][$id2] = array(
		'x' => array($x11, $x12, $x13, $x14), 
		'y' => array($y11, $y12, $y13, $y14),
		'w' => $w2,
		'h' => $h2
	);
	$o2["links"][$id1] = array(
		'x' => array(round($x21*$w2), round($x22*$w2), round($x23*$w2), round($x24*$w2)), 
		'y' => array(round($y21*$h2), round($y22*$h2), round($y23*$h2), round($y24*$h2)),
		'w' => $w1,
		'h' => $h1
	);

	save_image_data($o1);
	save_image_data($o2);

	$album_id = $o1["album_id"];
	header("Location: ./edit.html?id=$album_id");

?>