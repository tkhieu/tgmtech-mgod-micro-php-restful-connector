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


$app->post('/hello/:id', function ($id){
    $item = ORM::for_table('item_info')->create();
    
    
    
    if($_POST != null){
        $name =  $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $detail = $_POST['detail'];
        $username = $_POST['username'];
        $userid = $_POST['userid'];
        $situation =  $_POST['situation'];
        $price = $_POST['price'];
        $categoryname = $_POST['categoryname'];
        $categoryid = $_POST['categoryid'];            
    }
    
    $item->name = $name;
    $item->save();
});
$app->run();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
