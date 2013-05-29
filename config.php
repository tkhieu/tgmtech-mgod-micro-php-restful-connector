<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// Localhost config
//$mysql_add = "localhost";
//$mysql_username = "root";
//$mysql_password = "";

require __DIR__ . '/autoload.php';

class Config {

    // Authentication Config
    static public $key = "tgm-mgod";
    static public $secret = "cjpmrJG7nRqD9NDRFRKJSwNZKZybKe69Vt8Qd8cxmCEMGxSzPvGd4u4ftUDvZSWqV9hPmcWDytmb3UxshTKgGMUB72jaed7BBPRr";
    // MySQL Config
    static public $mysql_add = "us-cdbr-east-03.cleardb.com";
    static public $mysql_username = "b0f193c24de04b";
    static public $mysql_password = "4d21803e";
    static public $mysql_db = "heroku_30763ce34eaaa50";
    //Redis Config
    static $redis_server = array(
        'host' => 'pub-redis-19822.us-east-1-2.1.ec2.garantiadata.com',
        'port' => 19822,
        'password' => 'EWMTnsbqMT9bqnTQ'
    );

}

?>
