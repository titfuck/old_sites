<?php

	include('common.php');

	$tmp_name = "";
	$url = $_REQUEST['url'];
	if ($url && preg_match('/^http:\/\//', $url))
	{
		$tmp_name = tempnam("./data/", "tmp");
		copy($url, $tmp_name);
	} else
		$tmp_name = $_FILES['userfile']['tmp_name'];

	if (!$info = getimagesize($tmp_name) or $info[2] != IMAGETYPE_JPEG)
		exit;
	$width = (int)$info[0];
	$height = (int)$info[1];

	$id = random_id();
	mkdir("data/$id");
	$album_id = $_REQUEST['album_id'];
	if (!$album_id || ($album_id == ""))
	{
		$album_id = random_id();
		save_album_data(array("id" => $album_id, "images" => array()));
		error_log("creating album $album_id");
	}
	else
		$album_id = alphanumeric($album_id);
	save_image_data(array(
		"id" => $id, 
		"album_id" => $album_id, 
		"width" => $width, 
		"height" => $height, 
		"links" => array()
	));
	$album = load_album_data($album_id);
	$album["images"][$id] = true;
	save_album_data($album);

	$levels = 1;
	$tw = $width;
	$th = $height;
	while (($tw > 256) || ($th > 256))
	{
		$tw = ceil($tw/2);
		$th = ceil($th/2);
		$levels += 1;
	}

	$to_unlink = Array();
	while (true)
	{
		array_push($to_unlink, $tmp_name);
		`convert -crop 256x256 $tmp_name ./data/$id/$levels-%d.jpg`;
		if ($levels == 1)
			break;
		$levels -= 1;
		$new_tmp_name = tempnam("./temp", $id) . ".jpg";
		`convert -resize 50%x50% $tmp_name $new_tmp_name`;
		$tmp_name = $new_tmp_name;
	}
	foreach ($to_unlink as $name)
		unlink($name);

	`convert -resize 50%x50% ./data/$id/1-0.jpg ./data/$id/thumbnail.jpg`;

	header("Location: ./edit.html?id=$album_id");

?>