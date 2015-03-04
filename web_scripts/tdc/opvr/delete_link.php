<?php

	include('common.php');

	$id1 = alphanumeric($_REQUEST['id1']);
	$id2 = alphanumeric($_REQUEST['id2']);

	$o1 = load_image_data($id1);
	unset($o1["links"][$id2]);
	save_image_data($o1);
	
	$o2 = load_image_data($id2);
	unset($o2["links"][$id1]);
	save_image_data($o2);

	$album_id = $o1["album_id"];
	header("Location: ./edit.html?id=$album_id");

?>