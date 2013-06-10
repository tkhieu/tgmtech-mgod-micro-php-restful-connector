<?php

require_once './config.php';
require_once './Predis/Autoloader.php';
Predis\Autoloader::register();

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caching
 *
 * @author trankimhieu
 */
class Caching {

    //put your code here

    public static function write($prefix = "tgm-mgod", $key = '', $value = '') {
        $client = new Predis\Client(Config::$redis_server, array('prefix' => $prefix));
        return $client->set($key, $value);
    }

    public static function read($prefix = "tgm-mgod", $key) {
        $client = new Predis\Client(Config::$redis_server);
        return $client->get(Config::$redis_prefix . $key);
    }

    public static function delete($prefix = "tgm-mgod", $key) {
        $client = new Predis\Client(Config::$redis_server);
        try {
            return $client->del(Caching:: getListMatch(Config::$redis_prefix.$key));
        } catch (Exception $e) {
        }
    }

    public static function checkexist($prefix = "tgm-mgod", $key) {
        $client = new Predis\Client(Config::$redis_server);
        if ($client->exists(Config::$redis_prefix . $key))
            return true;
        else
            return false;
    }
    
    public static function getListMatch($param) {
        $client = new Predis\Client(Config::$redis_server);
        return $client->keys($param);
    }

}

?>
