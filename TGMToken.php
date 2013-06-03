<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TGMToken
 *
 * @author hieu
 */
class TGMToken {

    //put your code here

    static private $key = "tgm-mgod";
    static private $secret = "cjpmrJG7nRqD9NDRFRKJSwNZKZybKe69Vt8Qd8cxmCEMGxSzPvGd4u4ftUDvZSWqV9hPmcWDytmb3UxshTKgGMUB72jaed7BBPRr";

    public static function check($param) {
            //return true;
        $sign = $param["sign"];
        $app_key = $param["key"];
        $timestamp = $param["timestamp"];

        
        if ($app_key == TGMToken::$key) {
            /* @var $secret type */
            $check = md5(md5(TGMToken::$key . $timestamp) . md5($timestamp) . md5(TGMToken::$secret . $timestamp));
            $check_md5 = ($check);
            if ($check_md5 == $sign)
                return true;
            else
                return false;
        } else
            return false;
        
    }

    public static function getparams() {
        $headers = apache_request_headers();
        
        if ($headers['sign'] != null && $headers['key'] != null && $headers['timestamp'] != null) {
            $params = array("key" => $headers["key"], "sign" => $headers["sign"], "timestamp" => $headers["timestamp"]);
            return $params;
        }
        
       
    }

}

?>
