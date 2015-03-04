<?php

	include('common.php');

	$id = alphanumeric($_REQUEST['id']);
	$o = load_image_data($id);
	$o["description"] = $_REQUEST["description"];
	save_image_data($o);

	$album_id = $o["album_id"];
	header("Location: ./edit.html?id=$album_id");

?>