<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'a');
define('DB_PASSWORD', 'a');
define('DB_DATABASE', '99');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
