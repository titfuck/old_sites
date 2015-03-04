<?php

	function random_id()
	{	
		$chars = "abchefghjkmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$id = "";
		for ($i = 0; $i < 8; $i++) 
			$id .= substr($chars, rand() % strlen($chars), 1);
		return $id;
	}

	function numeric($arg)
	{
		if (!is_numeric($arg))
			exit();
		return $arg;
	}

	function alphanumeric($arg)
	{
		if (!preg_match('/^[a-zA-Z0-9]+$/', $arg))
			exit();
		return $arg;
	}

	function load_json($filename)
	{
		$fh = fopen($filename, "r");
		$str = fread($fh, 10000);
		fclose($fh);
		$str = substr($str, 4, strlen($str) - 6);
		return json_decode($str, true);
	}

	function save_json($filename, $data)
	{
		$fh = fopen($filename, "w");
		fwrite($fh, "nav(" . json_encode($data) . ");");
		fclose($fh);
	}

	function load_image_data($id) { return load_json("./data/$id/nav.js"); }
	function save_image_data($data) { save_json("./data/" . $data['id'] . "/nav.js", $data); }
	function load_album_data($id) { return load_json("./albums/$id.js"); }
	function save_album_data($data) { save_json("./albums/" . $data['id'] . ".js", $data); }

?>
