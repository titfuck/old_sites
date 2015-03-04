<?php

	include("common.php");

	$first_id = alphanumeric($_REQUEST["image_id"]);
	$first_o = load_image_data($first_id);
	$album_id = $first_o["album_id"];
	if (!$album_id)
	{
		$read_ids = array();
		$unread_ids = array($first_id => true);
		while (count($unread_ids) > 0)
		{
			$new_ids = array();
			foreach ($unread_ids as $id => $value)
			{				
				$o = load_image_data($id);
				foreach ($o["links"] as $link_id => $link_value)
					if (!$read_ids[$link_id] && !$unread_ids[$link_id])
						$new_ids[$link_id] = true;
				$read_ids[$id] = true;
			}
			$unread_ids = $new_ids;
		}

		$album_id = random_id();
		save_album_data(array("id" => $album_id, "images" => $read_ids));

		foreach ($read_ids as $id => $value)
		{	
			$o = load_image_data($id);
			$o["album_id"] = $album_id;
			save_image_data($o);
		}
	}
	header("Location: ./albums/$album_id.js");
	
?>