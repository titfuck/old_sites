<?php
require_once('joe.lib.php');
require_once('dbaccess.lib.php');
require_once('vote.lib.php');

$url = array_pop(explode('/',$_SERVER['REQUEST_URI']));

$sys = new VoteSystem();
$access = $sys->hasAccess();
$voter = $sys->getVoter();

$votes = $sys->getVotes();
?>

<h2>
<a href="/~tdc/vote/">TDC Vote</a> / <?=$voter['name']?>
</h2>

<?php

if (empty($url))
foreach($votes as $k=>$vote) {
	echo <<<EOV
<a href="$k">{$vote['title']}</a>
EOV;

} elseif (isset($votes[$url])) {
	echo "<h3>{$votes[$url]['title']}</h3>";

} else {
	echo "<p>Invalid selection.</p>";

}

//print_r($votes);
