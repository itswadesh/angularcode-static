<?php 
require_once '../../includes/config.php'; // The mysql database connection script
$status = '%';
if(isset($_GET['status'])){
  $status = $_GET['status'];
}
$query="select ID, TASK, STATUS from tasks where status like '$status' order by status,id desc";
$mysqli->query("SET NAMES 'utf8'"); 
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}
print_r(json_encode($arr));
?>