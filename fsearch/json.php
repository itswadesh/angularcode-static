<?php 
/**
* fSearch 2.0 - jQuery plugin for facebook type search suggestions
*
* http://www.codenx.com/
*
* Copyright (c) 2013 CodenX 
*/
if($_GET)
{
$q=$_GET['searchword'];
$items = array();
include('../includes/db.php'); // Includes database connection settings.
$sql_res=mysql_query("select uid,username,email,media,country from fsearch where username like '%$q%' or email like '%$q%' or country like '%$q%' order by uid LIMIT 5");
while($row=mysql_fetch_array($sql_res))
{
$uid = $row['uid'];
$username=$row['username'];
$email=$row['email'];
$media=$row['media'];
$country=$row['country'];
$b_username='<b>'.$q.'</b>';
$b_email='<b>'.$q.'</b>';
$b_country='<b>'.$q.'</b>';
$final_username = str_ireplace($q, $b_username, $username);
$final_email = str_ireplace($q, $b_email, $email);
$final_country = str_ireplace($q, $b_country, $country);
$items[] = array('uid' => $uid, 'username' => $final_username, 'email' => $final_email, 'country' => $final_country, 'media' => $media);
}
header('Content-Type:text/json');
echo json_encode($items);
}
else{
	echo json_encode('No search string found');
}
?>