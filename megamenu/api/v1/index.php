<?php
require '.././libs/Slim/Slim.php';
require_once 'dbHelper.php';

// Get Slim instance
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app = \Slim\Slim::getInstance();

// call our own dbHelper class
$db = new dbHelper();

/************ This can be called via http://localhost/angularcode-megamenu/api/v1/categories
List all categories where parent=0 and its sub categories ************/

$app->get('/categories', function() { 
    global $db;
    $rows = $db->select("categories","category cat_id,parent,description",array('parent'=>0),"ORDER BY description");

    // parent categories node
    $categories = array();

    foreach ($rows["data"] as $row) {
        $cat_id = $row["cat_id"];
        // select (TABLE_NAME,COLUMNS,CONDITION,WHERE_CLAUSE)
        $cr = $db->select("categories","category cat_id,parent,description",array('parent'=>$cat_id),"ORDER BY description");
        $category = array(); // temp array
        $category["cat_id"] = $row["cat_id"];
        $category["description"] = $row["description"];
        $category["sub_categories"] = array(); // subcategories again an array

        foreach ($cr["data"] as $srow) {
            $subcat = array(); // temp array
            $subcat["cat_id"] = $srow['cat_id'];
            $subcat["description"] = $srow['description'];
            // pushing sub category into subcategories node
            array_push($category["sub_categories"], $subcat);
        }

        // pushing sinlge category into parent
        array_push($categories, $category);
    }
    echoResponse(200, $categories);

});
function echoResponse($status_code, $response) {
    global $app;
    $app->status($status_code);
    $app->contentType('application/json');
    echo json_encode($response,JSON_NUMERIC_CHECK);
}

$app->run();
?>