<?php

/**
 * Status: 1 = alive, 0 = delete
 */

phpinfo();
//
//require 'Slim/Slim.php';
//require_once 'idiorm.php';
//require_once './rb.php';
//require_once './config.php';
//
//// Idiorm database config
//// Db Config
//
//$db_connect = "mysql:host=" . $mysql_add . "\;dbname=" . $mysql_db;
//ORM::configure($db_connect);
//ORM::configure('username', $mysql_username);
//ORM::configure('password', $mysql_password);
//ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
//// Return config
//ORM::configure('return_result_sets', true); // returns result sets
//// Config id column
//ORM::configure('id_column', 'id');
//
//// Redbean Config
//R::setup($db_connect, $mysql_username, $mysql_password);
//
//
//// Đăng ký Slim với request handle
//\Slim\Slim::registerAutoloader();
//// New một Slim App
//$app = new \Slim\Slim(array('mode' => 'development', 'debug' => 'false'));
//$app->response()->header('Content-Type', 'application/json');
//
//// POST /item/
//$app->post('/item/', function () {
//            // CONST
//            $success = ["status" => 1];
//            $false = ["status" => 0];
//            $json_success = json_encode($success);
//            $json_false = json_encode($false);
//            $item = ORM::for_table('item_info')->create();
//
//            try {
//                if ($_POST != null) {
//
//                    if ($_POST['name'] != null) {
//                        $name = $_POST['name'];
//                        $item->name = $name;
//                    }
//
//                    if ($_POST['topicid'] != null) {
//                        $topicid = $_POST['topicid'];
//                        $item->topicid = $topicid;
//                    }
//
//
//                    if ($_POST['phone'] != null) {
//                        $phone = $_POST['phone'];
//                        $item->phone = $phone;
//                    }
//
//                    if ($_POST['address'] != null) {
//                        $address = $_POST['address'];
//                        $item->address = $address;
//                    }
//
//
//                    if ($_POST['detail'] != null) {
//                        $detail = $_POST['detail'];
//                        $item->detail = $detail;
//                    }
//
//                    if ($_POST['username'] != null) {
//                        $username = $_POST['username'];
//                        $item->username = $username;
//                    }
//
//                    try {
//                        if ($_POST['userid'] != null) {
//                            $userid = $_POST['userid'];
//                            $item->userid = $userid;
//                        }
//                    } catch (Exception $exc) {
//                        //echo $exc->getTraceAsString();
//                    }
//
//
//
//
//
//                    if ($_POST['situation'] != null) {
//                        $situation = $_POST['situation'];
//                        $item->situation = $situation;
//                    }
//
//                    if ($_POST['price'] != null) {
//                        $price = $_POST['price'];
//                        $item->price = $price;
//                    }
//
//                    if ($_POST['categoryname'] != null) {
//                        $categoryname = $_POST['categoryname'];
//                        $item->categoryname = $categoryname;
//                    }
//
//                    if ($_POST['categoryid'] != null) {
//                        $categoryid = $_POST['categoryid'];
//                        $item->categoryid = $categoryid;
//                    }
//                    if ($_POST['images'] != null) {
//                        $images = $_POST['images'];
//                        $item->images = $images;
//                    }
//                }
//                $item->status = 1;
//                $item->posttime = time();
//                if ($item->save()) {
//                    echo $json_success;
//                    return;
//                }
//                else
//                    echo $json_false;
//                return;
//            } catch (Exception $exc) {
//                echo $exc->getTraceAsString();
//                echo $json_false;
//                return;
//            }
//
//
//            // Chuyển biến từ global POST sang biến địa phương
//            // Chuyển để dễ dàng control data type thay vì gán thẳng
//            // Đúng sẽ trả về true
//        });
//
//// GET /item/:id
//$app->get('/item/:id', function ($id) {
//            // CONST
//            $success = ["status" => 1];
//            $false = ["status" => 0];
//            $json_success = json_encode($success);
//            $json_false = json_encode($false);
//
//            if ($id == 'all') {
//                $items = R::find('item_info');
//                $result = R::exportAll($items);
//            } else {
//                $items = R::load('item_info', $id);
//                $result = R::exportAll($items)[0];
//            }
//            $json = json_encode($result);
//            if ($json == "{\"id\":0}")
//                echo $json_false;
//            else
//                echo $json;
//        });
//// PUT /item/:id
//$app->put('/item/:id', function ($id) use($app) {
//// CONST
//            $success = ["status" => 1];
//            $false = ["status" => 0];
//            $json_success = json_encode($success);
//            $json_false = json_encode($false);
//            try {
//                $item = ORM::for_table('item_info')->find_one($id);
//                $data = json_decode($app->getInstance()->request()->getBody());
//                $item->name = $data->name;
//
//                $item->name = $data->name;
//                $item->topicid = $data->topicid;
//                $item->phone = $data->phone;
//                $item->address = $data->address;
//                $item->detail = $data->detail;
//                $item->username = $data->username;
//                $item->userid = $data->userid;
//                $item->situation = $data->situation;
//                $item->price = $data->price;
//                $item->categoryname = $data->categoryname;
//                $item->categoryid = $data->categoryid;
//                $item->images = $data->images;
//                $item->updatetime = time();
//                if ($item->save())
//                    echo $json_success;
//                else
//                    echo $json_false;
//            } catch (Exception $exc) {
//                echo $json_false;
//            }
//        });
//
//// DELETE /item/:id
//$app->delete('/item/:id', function ($id) {
//// CONST
//            $success = ["status" => 1];
//            $false = ["status" => 0];
//            $json_success = json_encode($success);
//            $json_false = json_encode($false);
//            try {
//                $item = ORM::for_table('item_info')->find_one($id);
//                $status_before = $item->status;
//                $item->status = 0;
//                //R::trash($item);
//                $item->save();
//                $item_after = ORM::for_table('item_info')->find_one($id);
//                if ((int) $status_before == 1 && (int) $item_after->status == 0)
//                    echo $json_success;
//                else
//                    echo $json_false;
//            } catch (Exception $exc) {
//                echo $json_false;
//            }
//        });
//
//
//
//// GET /items/category/:id/:page/:limit
//$app->get('/items/category/:id/:page/:limit', function ($id, $page, $limit) {
//            $success = ["status" => 1];
//            $false = ["status" => 0];
//            $json_success = json_encode($success);
//            $json_false = json_encode($false);
//
//            try {
//                $offset = $page * $limit;
//
//                $items = R::find('item_info', 'categoryid = :id limit :limit offset :offset', array(':id' => $id, ':limit' => (int) $limit, 'offset' => (int) $offset));
//                $result = R::exportAll($items);
//                $json = json_encode($result);
//                echo $json;
//            } catch (Exception $exc) {
//                echo $json_false;
//            }
//        });
//// GET /items/username/:username/:page/:limit
//$app->get('/items/username/:username/:page/:limit', function ($username, $page, $limit) {
//            $success = ["status" => 1];
//            $false = ["status" => 0];
//            $json_success = json_encode($success);
//            $json_false = json_encode($false);
//            try {
//                $offset = $page * $limit;
//
//                $items = R::find('item_info', 'username = :username limit :limit offset :offset', array(':username' => $username, ':limit' => (int) $limit, 'offset' => (int) $offset));
//                $result = R::exportAll($items);
//                $json = json_encode($result);
//                echo $json;
//            } catch (Exception $exc) {
//                echo $json_false;
//            }
//        });
//$app->run();
//

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
