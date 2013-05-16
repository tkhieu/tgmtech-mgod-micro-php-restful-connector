<?php
require 'Slim/Slim.php';
require_once 'idiorm.php';

// Idiorm database config
// Db Config
ORM::configure('mysql:host=localhost;dbname=test-slim');
ORM::configure('username', 'root');
ORM::configure('password', '123456');

// Return config
ORM::configure('return_result_sets', true); // returns result sets
// Config id column
ORM::configure('id_column', 'id');


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array('mode'=>'development', 'debug'=>'true'));
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

// POST:/hello/
$app->post('/hello/', function (){
    $item = ORM::for_table('item_info')->create();

    // Chuyển biến từ global POST sang biến địa phương
    // Chuyển để dễ dàng control data type thay vì gán thẳng
    if($_POST != null){
        $name =  $_POST['name'];
//        $phone = $_POST['phone'];
//        $address = $_POST['address'];
//        $detail = $_POST['detail'];
//        $username = $_POST['username'];
//        $userid = $_POST['userid'];
//        $situation =  $_POST['situation'];
//        $price = $_POST['price'];
//        $categoryname = $_POST['categoryname'];
//        $categoryid = $_POST['categoryid'];            
    }
    
    // Đẩy biến vào trong ORM entity
    echo $name;
    
    $item->name = $name;
//    $item->phone = $phone;
//    $item->address = $address;
//    $item->detail = $address;
//    $item->username = $username;
//    $item->userid = $userid;
//    $item->situation = $situation;
//    $item->price = $price;
//    $item->categoryname = $categoryname;
//    $item->categoryid = $categoryid;
//    
//    $item->save();
});
$app->run();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
