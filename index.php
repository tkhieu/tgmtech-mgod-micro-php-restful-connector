<?php

// Require Autoload nhằm tự load các config và thư viện cần thiết
require_once './autoload.php';

// Khởi tạo Slim

$app = new \Slim\Slim(array('mode' => 'production', 'debug' => 'false'));

// Map Index về trang Docs
$app->map('/', function () use ($app) {
            $app->response()->header('Location', 'http://j.mp/tgm-mgod-rest');
            return;
        })->via('GET', 'POST');

/*
 * NHÓM DÀNH CHO ITEMS
 */

// POST /item/
$app->post('/item/', function () use($app) {

            // Chuyển Content-Type về JSON
            $app->response()->header('Content-Type', 'application/json');
            // Định nghĩa và chuyển về JSON các dạng status
            $success = array("status" => 1);
            $false = array("status" => 0);
            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $json_success = json_encode($success);
            $json_false = json_encode($false);
            // Lấy các Params của Token
            $param = TGMToken::getparams();
            
            if (TGMToken::check($param)) {
                // Tạo ra một biến $item và map vào bảng item_info
                $item = ORM::for_table('item_info')->create();

                // Lấy các thông tin từ biến POST
                try {
                    if ($_POST != null) {

                        if ($_POST['name'] != null) {
                            $name = $_POST['name'];
                            $item->name = $name;
                        }

                        if ($_POST['topicid'] != null) {
                            $topicid = $_POST['topicid'];
                            $item->topicid = $topicid;
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

                        try {
                            if ($_POST['userid'] != null) {
                                $userid = $_POST['userid'];
                                $item->userid = $userid;
                            }
                        } catch (Exception $exc) {
                            
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
                        if ($_POST['images'] != null) {
                            $images = $_POST['images'];
                            $item->images = $images;
                        }
                    }

                    // Đưa status = 1 => Item đó sử dụng được
                    $item->status = 1;
                    // Gán thời gian
                    $item->posttime = time();
                    $item->updatetime = time();
                    // Kiểm tra kết quả của hạnh động Save
                    if ($item->save()) {
                        echo $json_success;
                        try {
                            // Xoá cache của các namespace items trong redis để refresh cache
                            Caching::delete($prefix = Config::$redis_prefix, 'items:*');
                        } catch (Exception $exc) {
                            echo $exc->getTraceAsString();
                        }

                        return;
                    }
                    else
                    // Trả về khi false
                        echo $json_false;
                    return;
                } catch (Exception $exc) {
                    echo $json_false;
                    return;
                }
            } else {
                // Trả về khi auth false
                echo $json_auth_false;
            }
        });

// PUT /item/:id
$app->put('/item/:id', function ($id) use($app) {
            // Trả về JSON
            $app->response()->header('Content-Type', 'application/json');
            // Định nghĩa và Encode JSON
            $success = array("status" => 1);
            $false = array("status" => 0);
            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $json_success = json_encode($success);
            $json_false = json_encode($false);

            // Lấy Params của Token
            $param = TGMToken::getparams();
            echo var_dump($param);
            if (TGMToken::check($param)) {
                try {
                    // Tìm Item theo ID
                    $item = ORM::for_table('item_info')->find_one($id);
                    // Decode từ JSON về Object và chuyển qua Object của ORM
                    $data = json_decode($app->getInstance()->request()->getBody());
                    $item->name = $data->name;
                    $item->name = $data->name;
                    $item->topicid = $data->topicid;
                    $item->phone = $data->phone;
                    $item->address = $data->address;
                    $item->detail = $data->detail;
                    $item->username = $data->username;
                    $item->userid = $data->userid;
                    $item->situation = $data->situation;
                    $item->price = $data->price;
                    $item->categoryname = $data->categoryname;
                    $item->categoryid = $data->categoryid;
                    $item->images = $data->images;
                    $item->updatetime = time();

                    // Save xuống Db
                    if ($item->save()) {
                        echo $json_success;
                        // Refresh Cache
                        try {
                            Caching::delete($prefix = Config::$redis_prefix, 'item:' . $id);
                            Caching::delete($prefix = Config::$redis_prefix, 'items:*');
                        } catch (Exception $exc) {
                            
                        }
                    }
                    else
                        echo $json_false;
                } catch (Exception $exc) {
                    echo $json_false;
                }
            } else {
                echo $json_auth_false;
            }
        });

// DELETE /item/:id
$app->delete('/item/:id', function ($id) use($app) {
            // Chuyển về JSON
            $app->response()->header('Content-Type', 'application/json');
            // Định nghĩa và Encode JSON
            $success = array("status" => 1);
            $false = array("status" => 0);
            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $json_success = json_encode($success);
            $json_false = json_encode($false);

            $param = TGMToken::getparams();
            if (TGMToken::check($param)) {
                try {
                    $item = ORM::for_table('item_info')->find_one($id);
                    $status_before = $item->status;
                    $item->status = 0;
                    $item->save();
                    $item_after = ORM::for_table('item_info')->find_one($id);
                    if ((int) $status_before == 1 && (int) $item_after->status == 0) {
                        echo $json_success;
                        try {
                            Caching::delete($prefix = Config::$redis_prefix, 'item:' . $id);
                            Caching::delete($prefix = Config::$redis_prefix, 'items:*');
                        } catch (Exception $exc) {
                            
                        }
                    }
                    else
                        echo $json_false;
                } catch (Exception $exc) {
                    echo $json_false;
                }
            } else {
                echo $json_auth_false;
            }
        });

$app->get('/items/all', function () use($app) {
            $page = $_REQUEST['page'];
            $limit = $_REQUEST['limit'];

            if ($page == NULL)
                $page = 0;
            if ($limit == NULL)
                $limit = 10;

            $app->response()->header('Content-Type', 'application/json');
            $success = array("status" => 1);
            $false = array("status" => 0);
            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $json_success = json_encode($success);
            $json_false = json_encode($false);


            $param = TGMToken::getparams();
            if (TGMToken::check($param)) {

                if (Caching::checkexist($prefix = Config::$redis_prefix, $key = 'items:all' . ':page:' . $page . ':limit:' . $limit)) {
                    echo Caching::read($prefix = Config::$redis_prefix, $key = 'items:all' . ':page:' . $page . ':limit:' . $limit);
                } else {
                    $offset = $page * $limit;

                    $items = R::find('item_info', ' true order by updatetime DESC limit :limit offset :offset', array(':limit' => (int) $limit, 'offset' => (int) $offset));
                    $result = R::exportAll($items);
                    $json = json_encode($result);
                    if ($json == "{\"id\":0}")
                        echo $json_false;
                    else {
                        echo $json;
                        Caching::write(Config::$redis_prefix, 'items:all' . ':page:' . $page . ':limit:' . $limit, $json);
                    }
                }
            } else {
                echo $json_auth_false;
            }
        });
$app->get('/item/:id', function ($id) use ($app) {
            $app->response()->header('Content-Type', 'application/json');
            $success = array("status" => 1);
            $false = array("status" => 0);
            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $json_success = json_encode($success);
            $json_false = json_encode($false);

            $param = TGMToken::getparams();
            if (TGMToken::check($param)) {

                if (Caching::checkexist(Config::$redis_prefix, 'item:' . $id)) {
                    echo Caching::read(Config::$redis_prefix, 'item:' . $id);
                } else {
                    if ($id == 'all') {
                        $items = R::find('item_info', 'true order by updatetime');
                        $result = R::exportAll($items);
                    } else {
                        $items = R::load('item_info', $id);
                        $result = array_shift(R::exportAll($items));
                    }
                    $json = json_encode($result);
                    if ($json == "{\"id\":0}")
                        echo $json_false;
                    else {
                        echo $json;
                        Caching::write(Config::$redis_prefix, 'item:' . $id, $json);
                    }
                }
            } else {
                echo $json_auth_false;
            }
        });
$app->get('/items/category/:id', function ($id) use ($app) {
            $page = $_REQUEST['page'];
            $limit = $_REQUEST['limit'];

            if ($page == NULL)
                $page = 0;
            if ($limit == NULL)
                $limit = 10;

            $app->response()->header('Content-Type', 'application/json');
            $success = array("status" => 1);
            $false = array("status" => 0);
            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $json_success = json_encode($success);
            $json_false = json_encode($false);

            $param = TGMToken::getparams();
            if (TGMToken::check($param)) {

                if (Caching::checkexist(Config::$redis_prefix, 'items:category:' . $id . ':page:' . $page . ':limit:' . $limit)) {
                    echo Caching::read(Config::$redis_prefix, 'items:category:' . $id . ':page:' . $page . ':limit:' . $limit);
                } else {
                    try {
                        $offset = $page * $limit;

                        $items = R::find('item_info', 'categoryid = :id order by updatetime DESC limit :limit offset :offset', array(':id' => $id, ':limit' => (int) $limit, 'offset' => (int) $offset));
                        $result = R::exportAll($items);
                        $json = json_encode($result);
                        echo $json;
                        Caching::write(Config::$redis_prefix, 'items:category:' . $id . ':page:' . $page . ':limit:' . $limit, $json);
                    } catch (Exception $exc) {
                        echo $json_false;
                    }
                }
            } else {
                echo $json_auth_false;
            }
        });
$app->get('/items/username/:username', function ($username) use($app) {
            $page = $_REQUEST['page'];
            $limit = $_REQUEST['limit'];

            if ($page == NULL)
                $page = 0;
            if ($limit == NULL)
                $limit = 10;

            $app->response()->header('Content-Type', 'application/json');
            $success = array("status" => 1);
            $false = array("status" => 0);
            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $json_success = json_encode($success);
            $json_false = json_encode($false);

            $param = TGMToken::getparams();
            echo $param;
            if (TGMToken::check($param)) {

                if (Caching::checkexist(Config::$redis_prefix, 'items:username:' . $username . ':page:' . $page . ':limit:' . $limit)) {
                    echo Caching::read(Config::$redis_prefix, 'items:username:' . $username . ':page:' . $page . ':limit:' . $limit);
                } else {
                    try {
                        $offset = $page * $limit;
                        $items = R::find('item_info', 'username = :username order by updatetime DESC limit :limit offset :offset', array(':username' => $username, ':limit' => (int) $limit, 'offset' => (int) $offset));
                        $result = R::exportAll($items);
                        $json = json_encode($result);
                        echo $json;
                        Caching::write(Config::$redis_prefix, 'items:username:' . $username . ':page:' . $page . ':limit:' . $limit, $json);
                    } catch (Exception $exc) {
                        echo $json_false;
                    }
                }
            } else {
                echo $json_auth_false;
            }
        });


/*
 * 
 * FAVORTIE
 * 
 */



$app->post('/favorite/', function () use ($app) {
            $app->response()->header('Content-Type', 'application/json');
            $success = array("status" => 1);
            $false = array("status" => 0);
            $duplicate = array("status" => 2);
            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $json_success = json_encode($success);
            $json_false = json_encode($false);
            $json_duplicate = json_encode($duplicate);

            $param = TGMToken::getparams();
            if (TGMToken::check($param)) {
                $item = ORM::for_table('favorite_item')->find_one();
                $fav = ORM::for_table('favorite_item')->create();

                try {
                    if ($_POST != NULL) {
                        try {
                            if ($_POST['userid'] != null) {
                                $userid = $_POST['userid'];
                                $fav->userid = $userid;
                            }
                        } catch (Exception $exc) {
                            echo $exc->getTraceAsString();
                        }



                        if ($_POST['username'] != null) {
                            $username = $_POST['username'];
                            $fav->username = $username;
                        }

                        if ($_POST['itemid'] != null) {
                            $itemid = $_POST['itemid'];
                            $fav->itemid = $itemid;
                        }

                        if ($_POST['topicid'] != null) {
                            $topicid = $_POST['topicid'];
                            $fav->topicid = $topicid;
                        }


                        $item = ORM::for_table('favorite_item')->where('itemid', $itemid)->where('username', $username)->find_one();

                        if (!$item) {
                            if ($fav->save()) {
                                echo $json_success;
                                try {
                                    Caching::delete(Config::$redis_prefix, ':favorite:username:' . $username . ":*");
                                } catch (Exception $exc) {
                                    
                                }
                            }
                            else
                                echo $json_false;
                        } else {
                            echo $json_duplicate;
                        }
                    }
                } catch (Exception $exc) {
                    echo $json_false;
                }
            } else {
                echo $json_auth_false;
            }
        });

$app->delete('/favorite/:id', function ($id) use ($app) {
            $app->response()->header('Content-Type', 'application/json');
            $success = array("status" => 1);
            $false = array("status" => 0);
            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $json_success = json_encode($success);
            $json_false = json_encode($false);

            $param = TGMToken::getparams();
            if (TGMToken::check($param)) {
                try {
                    $item = ORM::for_table('favorite_item')->find_one($id);

                    try {
                        if ($item) {
                            Caching::delete(Config::$redis_prefix, ':favorite:username:' . $item->username . ":*");
                            $item->delete();
                            echo $json_success;
                        } else {
                            echo $json_false;
                        }
                    } catch (Exception $exc) {
                        echo $json_false;
                    }
                } catch (Exception $exc) {
                    echo $json_false;
                }
            } else {
                echo $json_auth_false;
            }
        });

$app->get('/favorite/:id', function ($id) use ($app) {
            $app->response()->header('Content-Type', 'application/json');
            $success = array("status" => 1);
            $false = array("status" => 0);
            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $json_success = json_encode($success);
            $json_false = json_encode($false);

            $param = TGMToken::getparams();
            if (TGMToken::check($param)) {
                if (Caching::checkexist(onfig::$redis_prefix, ':favorite:' . $id)) {
                    echo Caching::read(onfig::$redis_prefix, ':favorite:' . $id);
                } else {
                    try {
                        $items = R::load('favorite_item', $id);
                        $result = array_shift(R::exportAll($items));
                        $json = json_encode($result);
                        if ($json == "{\"id\":0}")
                            echo $json_false;
                        else
                            echo $json;
                        Caching::write(Config::$redis_prefix, ':favorite:' . $id, $json);
                    } catch (Exception $exc) {
                        echo $json_false;
                    }
                }
            } else {
                echo $json_auth_false;
            }
        });

$app->get('/favorite/username/:username', function ($username) use ($app) {
            $app->response()->header('Content-Type', 'application/json');
            $page = $_REQUEST['page'];
            $limit = $_REQUEST['limit'];

            if ($page == NULL)
                $page = 0;
            if ($limit == NULL)
                $limit = 10;

            $auth_false = array("error" => "Authentication false");
            $json_auth_false = json_encode($auth_false);
            $false = array("status" => 0);
            $json_false = json_encode($false);

            $param = TGMToken::getparams();
            if (TGMToken::check($param)) {

                if (Caching::checkexist(Config::$redis_prefix, ':favorite:username:' . $username . ':page:' . $page . ':limit:' . $limit)) {
                    echo Caching::read(Config::$redis_prefix, ':favorite:username:' . $username . ':page:' . $page . ':limit:' . $limit);
                } else {

                    try {

                        $offset = $page * $limit;

                        $items = R::find('item_info', 'id in (SELECT itemid FROM favorite_item WHERE username = :username ) limit :limit offset :offset', array(':username' => $username, ':limit' => (int) $limit, 'offset' => (int) $offset));
                        $result = R::exportAll($items);
                        $json = json_encode($result);
                        echo $json;
                        Caching::write(Config::$redis_prefix, ':favorite:username:' . $username . ':page:' . $page . ':limit:' . $limit, $json);
                    } catch (Exception $exc) {
                        echo $json_false;
                    }
                }
            } else {
                echo $json_auth_false;
            }
        });
$app->run();
?>
