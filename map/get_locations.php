<?php
     
    require 'config.php';
     
    try {
     
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        $sth = $db->query("SELECT id,DATE_FORMAT(STR_TO_DATE(created,'%d%m%y%H%i%s'), '%d-%b-%Y %h:%i %p') created,latitude,longitude,imei FROM gps_location");
        $locations = $sth->fetchAll();
         
        echo json_encode( $locations );
         
    } catch (Exception $e) {
        echo $e->getMessage();
    }