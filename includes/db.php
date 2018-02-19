<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'wp');
define('DB_PASSWORD', 'swadesh0');
define('DB_DATABASE', 'demos');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
