<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['imei']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
    
    $id = $_POST['id'];
    $imei = $_POST['imei'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $created = $_POST['created'];
    $sent = $_POST['sent'];
// print_r($imei.$latitude.$longitude.$creted.$sent);
    // include db connect class
    require_once 'db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
    $result = mysql_query("INSERT INTO gps_location(id, imei, latitude, longitude, created, sent) VALUES('$id', '$imei', '$latitude', '$longitude', '$created', '$sent')");

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred".$imei.$latitude.$longitude.$creted.$sent;
        
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>