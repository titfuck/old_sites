<?php
define('DB_HOST','sql.mit.edu');
define('DB_USER','tdc');
define('DB_PASS','tdsequel');
define('DB_NAME','tdc+social');

mysql_connect(DB_HOST,DB_USER,DB_PASS);
mysql_select_db(DB_NAME);

require_once('joe.lib.php');
require_once('mysql.lib.php');
