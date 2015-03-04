<?php
	$o = json_decode('{"id": "a1", "width": 1536, "height": 2048, "links": {}}', true);
	$o["links"]["a"] = array("b" => array(0, 1), "c" => "d");
	echo json_encode($o);
?>