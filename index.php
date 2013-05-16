<?php

require 'Slim/Slim.php';
require_once 'idiorm.php';
require_once './rb.php';

// Idiorm database config
// Db Config
ORM::configure('mysql:host=localhost;dbname=test-slim');
ORM::configure('username', 'root');
ORM::configure('password', '123456');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// Return config
ORM::configure('return_result_sets', true); // returns result sets
// Config id column
ORM::configure('id_column', 'id');


// Redbean Config
R::setup('mysql:host=localhost;dbname=test-slim', 'root', '123456');

//R::freeze(true);


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array('mode' => 'development', 'debug' => 'true'));
$app->response()->header('Content-Type', 'application/json');
// POST:/item/
$app->post('/item/', function () {
            $item = ORM::for_table('item_info')->create();

            // Chuyển biến từ global POST sang biến địa phương
            // Chuyển để dễ dàng control data type thay vì gán thẳng
            if ($_POST != null) {

                if ($_POST['name'] != null) {
                    $name = $_POST['name'];
                    $item->name = $name;
                }

                if ($_POST['phone'] != null) {
                    $phone = $_POST['phone'];
                    $item->phone = $phone;
                }

                if ($_POST['address'] != null) {
                    $address = $_POST['address'];
                    $item->address = $address;
                }


                if ($_POST['detail'] != null) {
                    $detail = $_POST['detail'];
                    $item->detail = $detail;
                }

                if ($_POST['username'] != null) {
                    $username = $_POST['username'];
                    $item->username = $username;
                }

                if ($_POST['userid'] != null) {
                    $userid = $_POST['userid'];
                    $item->userid = $userid;
                }

                if ($_POST['situation'] != null) {
                    $situation = $_POST['situation'];
                    $item->situation = $situation;
                }

                if ($_POST['price'] != null) {
                    $price = $_POST['price'];
                    $item->price = $price;
                }

                if ($_POST['categoryname'] != null) {
                    $categoryname = $_POST['categoryname'];
                    $item->categoryname = $categoryname;
                }

                if ($_POST['categoryid'] != null) {
                    $categoryid = $_POST['categoryid'];
                    $item->categoryid = $categoryid;
                }
            }
            return $item->save();
        });

// GET:/item/:id
$app->get('/item/:id', function ($id) {
            $item = R::load('item_info', $id);
            echo json_encode(R::exportAll($item));
        });


$app->put('/item/:id', function ($id) use($app) {
            $item = ORM::for_table('item_info')->find_one($id);
            $data = json_decode($app->getInstance()->request()->getBody());
            $item->name = $data->name;
                        
            $item->name = $data->name;
            $item->phone = $data->phone;
            $item->address = $data->address;
            $item->detail = $data->detail;
            $item->username = $data->username;
            $item->userid = $data->userid;
            $item->situation = $data->situation;
            $item->price = $data->price;
            $item->categoryname = $data->categoryname;
            $item->categoryid = $data->categoryid;
            $item->save();
            //return $item->save();
        });
// Rub the App
$app->run();


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
