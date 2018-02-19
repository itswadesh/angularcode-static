<?php

require '.././libs/Slim/Slim.php';

require_once 'dbHelper.php';



\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app = \Slim\Slim::getInstance();

$db = new dbHelper();



/**

 * Database Helper Function templates

 */

/*

select(table name, where clause as associative array)

insert(table name, data as associative array, mandatory column names as array)

update(table name, column names as associative array, where clause as associative array, required columns as array)

delete(table name, where clause as array)

*/

// require_once 'file.php';

require_once 'authentication.php';

function myScandir(&$parentDir,$actual_dir){

        $scanDir = scandir($actual_dir);

        for ($i=0;$i<count($scanDir);$i++){

                if ($scanDir[$i] == '.svn' || $scanDir[$i] == '.' || $scanDir[$i] == '..' ) {

                        continue;

                }

                if (is_file($actual_dir.'/'.$scanDir[$i])){

                        $file = $scanDir[$i];

                        

                        array_push($parentDir,$file);

                } elseif (is_dir($actual_dir.'/'.$scanDir[$i])){

                        $dir =  $scanDir[$i];

                        if(count(scandir($actual_dir."/".$dir))<=2){

                         	rmdir($actual_dir."/".$dir);

                        }

                        $parentDir[$dir]=array();

                        myScandir( $parentDir[$dir] , "$actual_dir/$dir" );

                }

        }

        return true;

}

function file_size($size)

{

$filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");

    return $size ? round($size/pow(1024, ($i = floor(log($size, 1024))))) . $filesizename[$i] : '0 Bytes';

}


$app->post('/saveGPS', function() use ($app) { 
    $a = json_decode($app->request->getBody());
    echoResponse(200, $a);
});

$app->get('/get-location/:imei', function($imei) { 
    global $db;
    $rows = $db->select("gps_location","id,DATE_FORMAT(STR_TO_DATE(created,'%d%m%y%H%i%s'), '%d-%b-%Y %h:%i %p') created,latitude,longitude,imei", array('imei'=>$imei));
    echoResponse(200, $rows["data"]);
});


$app->get('/androidRec/:sim', function($sim) { 

    // $print_dir = '../../../tmp';

    $print_dir = '../../../demos/AndroidRec/'.$sim;

    

    $parentDir=array();

    $rows = array();

    myScandir($parentDir,$print_dir);

    foreach ($parentDir as $f=>$f1) {

            global $db;

            $fb = str_replace(' ', '', $f);

            $c = $db->select("contacts","name", array('phone'=>substr($fb,-10)));

            if($c["status"]=="success"){

                $cn = $c["data"][0]["name"];

            }else{

                $cn = $f;

            }

     

            foreach ($f1 as $k) {

                    $fz = filesize($print_dir.'/'.$f.'/'.$k);

                    $file_size = file_size(filesize($print_dir.'/'.$f.'/'.$k));

                    // if($fz>70000){

                        $object = new stdClass();

                        $object->flag = substr($f,0,1);

                        $object->file = $k;

                        $object->dir = $f;

                        $object->size = $fz;

                        $object->cname = $cn;

                        $object->MB = $file_size;

        try{

            /*$dt = '20'.substr($k,4,2).'-'.substr($k,2,2).'-'.substr($k,0,2);

            // $dt1 = '20'.substr($k,4,2).'/'.substr($k,2,2).'/'.substr($k,0,2);

            $tm = .' '.substr($k,6,2).':'.substr($k,8,2).':'.substr($k,10,2);

            $date = new DateTime($dt.$tm);

                        

            $object->dt = $date->format('d-M-Y h:i:s A');

            // $object->dt1 = new DateTime($dt1.$tm);*/

            $dt = '20'.substr($k,4,2).'-'.substr($k,2,2).'-'.substr($k,0,2);

            $dt1 = '20'.substr($k,4,2).'/'.substr($k,2,2).'/'.substr($k,0,2);

            $tm = ' '.substr($k,6,2).':'.substr($k,8,2).':'.substr($k,10,2);

            $date = new DateTime($dt.$tm);

                        

            // $object->dt = $date->format('d-M-Y h:i:s A');

            $object->dt = $dt1.$tm;

        }catch (Exception $e){

            $object->dt = $k;

        }

                        $rows[] = $object;

                        // }

                    }

            }       



$price = array();

foreach ($rows as $key => $row)

{

    $price[$key] = $row->dt;

}

array_multisort($price, SORT_DESC, $rows);

// print_r($price);

$obj = new stdClass();

$obj->data = $rows;

    echoResponse(200, $obj);

});



$app->post('/androidRecord/:sim', function($sim) use ($app) { 

    $a = json_decode($app->request->getBody());

    $dir = $a->dir;

    $file = $a->file;

    $print_dir = '../../../demos/AndroidRec/'.$sim;

    unlink($print_dir.'/'.$dir.'/'.$file);

    $rows = array();

    $rows["message"] = "File removed successfully.";

    echoResponse(200, $rows);

});

$app->post('/androidRec/:sim', function($sim) use ($app) { 

    // $a = json_decode($app->request->getBody());

    $dir = $app->request->post('dir');

    $file = $app->request->post('file');

    // $dir = $a->dir;

    // $file = $a->file;

    // print_r($dir);

    $print_dir = '../../../demos/AndroidRec/'.$sim;

    unlink($print_dir.'/'.$dir.'/'.$file);

    $rows = array();

    $rows["message"] = "File removed successfully.";

    echoResponse(200, $rows);

});



$app->get('/routes', function() { 

    global $db;

    $rows = $db->select("routes","*",array());

    echoResponse(200, $rows);

});



$app->get('/settings', function() { 

    global $db;

    $rows = $db->select("settings","id,name,title,description,logo,email,paypal",array());

    echoResponse(200, $rows);

});



$app->put('/settings/:id', function($id) use ($app) { 

    $data = json_decode($app->request->getBody());

    $condition = array('id'=>$id);

    $mandatory = array();

    global $db;

    $rows = $db->update("settings", $data, $condition, $mandatory);

    if($rows["status"]=="success")

        $rows["message"] = "Settings saved successfully.";

    echoResponse(200, $rows);

});



$app->get('/customer/:id', function($id) { 

    global $db;

    $rows = $db->select("users","uid,email,name,address,city, status", array('phone'=>$id));

    echoResponse(200, $rows);

});



$app->get('/profile', function() { 

    global $db;

    if (!isset($_SESSION)) {

        session_start();

    }

    $uid = $_SESSION['uid'];

    $rows = $db->select("users","uid,email,name,phone,address,city,access_level,status",array('uid'=>$uid));

    echoResponse(200, $rows);

});



$app->put('/profile/:uid', function($uid) use ($app) { 

    $data = json_decode($app->request->getBody());

    $condition = array('uid'=>$uid);

    $mandatory = array();

    global $db;

    $rows = $db->update("users", $data, $condition, $mandatory);

    if($rows["status"]=="success")

        $rows["message"] = "User profile saved successfully.";

    echoResponse(200, $rows);

});



// Roles 

$app->get('/roles/:uid', function($uid) { 

    global $db;

    $rows = $db->select("user_roles","*",array('uid'=>$uid));

    echoResponse(200, $rows);

});



$app->get('/users', function() { 

    global $db;

    $rows = $db->select("users","uid,email,name,phone,address,city,access_level role,status",array());

    echoResponse(200, $rows);

});



$app->get('/users/:id', function($id) { 

    global $db;

    $rows = $db->select("users","uid,email,name,phone,address,city, status", array('uid'=>$id));

    echoResponse(200, $rows);

});



$app->put('/users/:uid', function($uid) use ($app) { 

    $data = json_decode($app->request->getBody());

    $condition = array('uid'=>$uid);

    $mandatory = array();

    global $db;

    $rows = $db->update("users", $data, $condition, $mandatory);

    if($rows["status"]=="success")

        $rows["message"] = "User information updated successfully.";

    echoResponse(200, $rows);

});



$app->delete('/brands/:id', function($id) { 

    global $db;

    $rows = $db->delete("brands", array('id'=>$id));

    if($rows["status"]=="success")

        $rows["message"] = "Brand removed successfully.";

    echoResponse(200, $rows);

});



$app->post('/brands', function() use ($app) { 

    $data = json_decode($app->request->getBody());

    $mandatory = array('description');

    global $db;

    $rows = $db->insert("brands", $data, $mandatory);

    if($rows["status"]=="success")

        $rows["message"] = "Brand added successfully.";

    echoResponse(200, $rows);

});



$app->put('/brands/:id', function($id) use ($app) { 

    $data = json_decode($app->request->getBody());

    $condition = array('id'=>$id);

    $mandatory = array();

    global $db;

    $rows = $db->update("brands", $data, $condition, $mandatory);

    if($rows["status"]=="success")

        $rows["message"] = "Brand information updated successfully.";

    echoResponse(200, $rows);

});

$app->get('/all-categories', function() { 
    global $db;
    $qr="select * from categories";
    $rows=$db->select3($qr,array());
    echoResponse(200, $rows);
});

// Active Products

$app->get('/products-all', function() { 
    global $db;
    $rows = $db->select("products","id,sku,name,description,price,mrp,brand,stock,image,packing,category,status", array());
    echoResponse(200, $rows);
});

// Products

$app->get('/products', function() { 
    global $db;
    $qr="select p.id,p.sku,concat(b.description,' ',p.name) name,p.description,p.price,p.mrp,p.brand,p.stock,p.image,p.packing,p.category,if(p.status=0,'Active','Inactive') as status from products p, brands b where p.brand=b.brand and p.status=? order by p.name";
    $rows=$db->select3($qr,array('p.status'=>0));
    echoResponse(200, $rows);
});

$app->get('/products/:id', function($id) { 

    global $db;

    $rows = $db->select("products","id,sku,name,description,price,mrp,brand,stock,image,packing,category,if(status=0,'Active','Inactive') as status", array('id'=>$id));

    echoResponse(200, $rows);

});

// Brands

$app->get('/brands', function() { 
    global $db;
    $rows = $db->select2("brands","id,brand,parent,description,status",array(),'order by description');
    echoResponse(200, $rows);
});

$app->get('/subcategories', function() { 
    global $db;
    $rows = $db->select2("categories","id,category,parent,description,if(status=0,'Active','Inactive') as status",array(),'order by description');
    echoResponse(200, $rows);
});



/*$app->get('/categories', function() {

global $db;

$rows = $db->select2("categories","category cat_id,parent,description,image", array(), "order by parent,id");//");

$elems = array();

print_r($rows["data"]);

while(($row = $rows["data"])) {

    $row['children'] = array();

    $vn = "row" . $row['cat_id'];

    ${$vn} = $row;

    if(!is_null($row['parent'])) {

        $vp = "parent" . $row['parent'];

        if(isset($data[$row['parent']])) {

            ${$vp} = $data[$row['parent']];

        }

        else {

            ${$vp} = array('cat_id' => $row['parent'], 'parent' => null, 'children' => array());

            $data[$row['parent']] = &${$vp};

        }

        ${$vp}['children'][] = &${$vn};

        $data[$row['parent']] = ${$vp};

    }

    $data[$row['cat_id']] = &${$vn};

}



$result = array_filter($data, function($elem) { return is_null($elem['parent']); });



    echoRespnse(200, $result);

});*/

$app->get('/categories', function() { 

    global $db;

    $rows = $db->select("categories","category cat_id,parent,description,image",array('parent'=>0));

    // $sql = mysqli_query($db,"select cat_id,name,media from categories where parent=0");



    // parent categories node

    $categories = array();



    foreach ($rows["data"] as $row) {

        $cat_id = $row["cat_id"];

        // $ssql = mysqli_query($db,"select cat_id,description,media from categories where parent='$cat_id'");

        $cr = $db->select2("categories","category cat_id,parent,description,image",array('parent'=>$cat_id),"ORDER BY description");

        // print_r($cr);

        // single category node

        $category = array(); // temp array

        $category["cat_id"] = $row["cat_id"];

        $category["description"] = $row["description"];

        $category["image"] = $row["image"];

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

    // echo ((isset($_GET['callback'])) ? $_GET['callback'] : "") . '(' . json_encode($categories) . ')';

        echoResponse(200, $categories);

});

$app->get('/orders', function() { 

    global $db;

    // $uid = 0;

    if (!isset($_SESSION)) {session_start();}

        $uid = $_SESSION['uid'];

    $rows = $db->select("orders","id, order_no, DATE_FORMAT(order_date,'%d-%M-%Y %h:%m:%s %p') order_date,  uid, sku, name, price, quantity,(price*quantity) sub_total, packing, status",array('uid'=>$uid));

    $rows["orders"] = array();

    $arr = array();

    $order_total = 0;

    if(count($rows["data"])>0){

        foreach($rows["data"] as $row) {

            $order_total += $row['sub_total'];

            $arr[$row['order_no']]['order_no'] = $row['order_no'];

            $arr[$row['order_no']]['id'] = $row['id'];

            $arr[$row['order_no']]['order_date'] = $row['order_date'];

            $arr[$row['order_no']]['order_total'] = $order_total;



            $temp = array('sku' => $row['sku'], 'name' => $row['name'], 'price' => $row['price'], 'quantity' => $row['quantity'], 'packing' => $row['packing'], 'sub_total' => $row['sub_total'], 'status' => $row['status']);



            // New order is ADDED

            $arr[$row['order_no']]['items'][] = $temp;

        }

    }

    $base_out = array();



    foreach ($arr as $key => $record) {

        // IDs were necessary before, to keep track of ports (by id), 

        // but they bother json now, so we do...

        $base_out[] = $record;

        // $base_out["total"] = $

    }

    echoResponse(200, $base_out);

});

$app->get('/orders/:phone', function($phone) { 

    global $db;

    $rows = $db->select("orders","id, order_no, DATE_FORMAT(order_date,'%d-%M-%Y %h:%m:%s %p') order_date,  uid, sku, name, price, quantity,(price*quantity) sub_total, packing, status",array('phone'=>$phone));

    // print_r($rows);

    $rows["orders"] = array();

    $arr = array();

    $order_total = 0;

    if(count($rows["data"])>0){

        foreach($rows["data"] as $row) {

            $order_total += $row['sub_total'];

            $arr[$row['order_no']]['order_no'] = $row['order_no'];

            $arr[$row['order_no']]['id'] = $row['id'];

            $arr[$row['order_no']]['order_date'] = $row['order_date'];

            $arr[$row['order_no']]['order_total'] = $order_total;



            $temp = array('sku' => $row['sku'], 'name' => $row['name'], 'price' => $row['price'], 'quantity' => $row['quantity'], 'packing' => $row['packing'], 'sub_total' => $row['sub_total'], 'status' => $row['status']);



            // New order is ADDED

            $arr[$row['order_no']]['items'][] = $temp;

        }

    }

    $base_out = array();



    foreach ($arr as $key => $record) {

        // IDs were necessary before, to keep track of ports (by id), 

        // but they bother json now, so we do...

        $base_out[] = $record;

        // $base_out["total"] = $

    }

    echoResponse(200, $base_out);

});



$app->post('/orders', function() use ($app) { 

        $data = json_decode($app->request->getBody());

        $order_no = strtoupper(substr(md5(uniqid(mt_rand(), true)),0,8));

        $mandatory = array();

        global $db;

        $rows = array();;

        $uid = 0;

        if (isset($_SESSION)) {

            $uid = $_SESSION['uid'];

        }

        // $data = (object) array_merge( (array)$data, array( 'bar' => '1234' ) );

        foreach ($data as $o) {

            $o->uid = $uid;

            $o->order_no = $order_no;

            $rows = $db->insert("orders", $o, $mandatory);

            if($rows["status"] == "success")

            $rows["message"] = "Order placed successfully.";

        }

    echoResponse(200, $rows);

});



$app->put('/orders', function() use ($app) { 

    $data = json_decode($app->request->getBody());

    $status=$data->status;

    // $condition = array('date(order_date)'=>$data->orderDate, 'phone' => $data->phone);

    // $mandatory = array();

    global $db;



    $stmt =  $db->getDb()->prepare("UPDATE orders SET status='$status' WHERE date(order_date)='$data->orderDate' and phone='$data->phone'");

    $stmt->execute();

    $rows = $stmt->rowCount();

    // $rows = $tdb->update("orders", $fields, $condition, $mandatory);

    // if($rows["status"]=="success")

    //     $rows["message"] = "Order status updated successfully.";

    echoResponse(200, $rows);

});



$app->delete('/categories/:id', function($id) { 

    global $db;

    $rows = $db->delete("categories", array('id'=>$id));

    if($rows["status"]=="success")

        $rows["message"] = "Category removed successfully.";

    echoResponse(200, $rows);

});



$app->post('/categories', function() use ($app) { 

    $data = json_decode($app->request->getBody());

    $mandatory = array('description');

    global $db;

    $rows = $db->insert("categories", $data, $mandatory);

    if($rows["status"]=="success")

        $rows["message"] = "Category added successfully.";

    echoResponse(200, $rows);

});



$app->put('/categories/:id', function($id) use ($app) { 

    $data = json_decode($app->request->getBody());

    $condition = array('id'=>$id);

    $mandatory = array();

    global $db;

    $rows = $db->update("categories", $data, $condition, $mandatory);

    if($rows["status"]=="success")

        $rows["message"] = "Category information updated successfully.";

    echoResponse(200, $rows);

});



$app->post('/products', function() use ($app) { 

    $data = json_decode($app->request->getBody());

    $mandatory = array('name');

    global $db;

    $rows = $db->insert("products", $data, $mandatory);

    if($rows["status"]=="success")

        $rows["message"] = "Product added successfully.";

    echoResponse(200, $rows);

});



$app->put('/products/:id', function($id) use ($app) { 

    $data = json_decode($app->request->getBody());

    $condition = array('id'=>$id);

    $mandatory = array();

    global $db;

    $rows = $db->update("products", $data, $condition, $mandatory);

/*    if($rows["status"]=="success")

       $rows["message"] = "Product information updated successfully.";
*/
    echoResponse(200, $rows);

});



$app->delete('/products/:id', function($id) { 

    global $db;

    $rows = $db->delete("products", array('id'=>$id));

    if($rows["status"]=="success")

        $rows["message"] = "Product removed successfully.";

    echoResponse(200, $rows);

});



// $db->selectP('simpleproc');

//require_once 'authentication.php';



function validateEmail($email) {

    $app = \Slim\Slim::getInstance();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $response["error"] = true;

        $response["message"] = 'Email address is not valid';

        echoResponse(200, $response);

        $app->stop();

    }

}



function echoResponse($status_code, $response) {

    global $app;

    $app->status($status_code);

    $app->contentType('application/json');

    echo json_encode($response,JSON_NUMERIC_CHECK);

}



$app->run();

?>