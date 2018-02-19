<?php
$mysql_hostname = "mysql3.000webhost.com";
$mysql_user = "a5214129_fb";
$mysql_password = "facebook0";
$mysql_database = "a5214129_fb";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");

?>