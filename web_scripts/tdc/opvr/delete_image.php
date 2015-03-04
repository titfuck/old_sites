<?php

	include('common.php');

	$id = alphanumeric($_REQUEST['id']);
	$o = load_image_data($id);
	foreach ($o["links"] as $id2 => $v)
	{
		$o2 = load_image_data($id2);
		unset($o2["links"][$id]);
		save_image_data($o2);
	}
	$album_id = $o["album_id"];
	if ($album_id)
	{
		$album = load_album_data($album_id);
		unset($album["images"][$id]);
		save_album_data($album);
	}
	unlink("data/$id/nav.js");
	unlink("data/$id/thumbnail.jpg");

	header("Location: ./edit.html?id=$album_id");

?>