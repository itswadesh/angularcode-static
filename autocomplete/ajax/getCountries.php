<?php 
require_once '../../includes/config.php';

$query="select distinct c.country, c.capital from countries c order by 1";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}


# JSON-encode the response
echo $json_response = json_encode($arr);
?>