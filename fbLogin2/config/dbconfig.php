<?php

define('DB_SERVER', 'mysql3.000webhost.com');
define('DB_USERNAME', 'a5214129_fb');
define('DB_PASSWORD', 'facebook0');
define('DB_DATABASE', 'a5214129_fb');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
