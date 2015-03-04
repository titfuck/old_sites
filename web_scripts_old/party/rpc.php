<?php
require_once('party.lib.php');

header('Content-type: text/javascript');

import_request_variables('gp','i_');

if (isset($i_partyID)) {
	if (isset($i_popAdjust) && isset($i_partyPop)) {
		$partyPop = $i_partyPop + $i_popAdjust;
		printf('$("partyPop").value = "%s";', $partyPop);
		printf('Form.enable(\'checkin\');');
		printf('$(\'%s\').focus();',"in[name]");
		flush();
		$s = sprintf("update parties set partypop = partypop + '%s' where partyid = '%s'",
				mysql_escape_string($i_popAdjust),
				mysql_escape_string($i_partyID));
		DBUpdate($s);
		exit;
	} elseif (isset($i_in) && !empty($i_in['name'])) {
		printf('popAdjust(1);');
		$arr = array(
			'partyid' => $i_partyID,
			'visitorname' => $i_in['name'],
			'visitorage' => $i_in['age'],
			'visitorhome' => $i_in['home'],
			'visitoremail' => $i_in['email'],
			'dentered' => 'NOW()');
		$s = 'insert into visitors ' . buildSQLInsert($arr);
		DBInsert($s);
		printf('Form.reset(\'checkin\');');
		printf('Form.enable(\'checkin\');');
		printf('$(\'%s\').focus();',"in[name]");
		exit;
	}
}
