<?php
define('DATABASE_HOST', "localhost");
define('DATABASE_NAME', "u939370758_demos");
define('DATABASE_USERNAME', "u939370758_demos");
define('DATABASE_PASSWORD', "swadesh0");

class Database {
	function runQuery($sql) {
		$conn = new mysqli(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $conn->query("SET NAMES 'utf8'"); 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $resultset[] = $row;
      }
    }
    $conn->close();

		if(!empty($resultset))
			return $resultset;
	}
}

$database = new Database();

$result = $database->runQuery("SELECT * FROM demos order by id desc");
print_r(json_encode($result));
?>