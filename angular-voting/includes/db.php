<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'fb');
define('DB_PASSWORD', 'fb');
define('DB_DATABASE', 'voting');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
