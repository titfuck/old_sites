<?php
header('Content-type: text/javascript');
?>
test = function x() {
	alert('test');
}
document.write('<a href="javascript:test();">test</a>');
document.close();
