<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Slim/Slim.php';
require_once './idiorm.php';
require_once './rb.php';
require_once './config.php';
require_once './Caching.php';

$db_connect = "mysql:host=" . Config::$mysql_add . ";dbname=" . Config::$mysql_db;
ORM::configure($db_connect);
ORM::configure('username', Config::$mysql_username);
ORM::configure('password', Config::$mysql_password);
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// Return config
ORM::configure('return_result_sets', true); // returns result sets
// Config id column
ORM::configure('id_column', 'id');

// Redbean Config
R::setup($db_connect, Config::$mysql_username, Config::$mysql_password);


// Đăng ký Slim với request handle
\Slim\Slim::registerAutoloader();

?>
