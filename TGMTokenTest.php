<?php

require_once './TGMToken.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$key = "tgm-mgod";
$secret = "cjpmrJG7nRqD9NDRFRKJSwNZKZybKe69Vt8Qd8cxmCEMGxSzPvGd4u4ftUDvZSWqV9hPmcWDytmb3UxshTKgGMUB72jaed7BBPRr";

$timestamp = "1";

echo $temp = md5($key.$timestamp);
$temp2 =  md5($timestamp);
$temp3 = md5($secret.$timestamp);

$temp4 = $temp.$temp2.$temp3;
$sign = md5($temp4);

$param = array("key"=>$key,"sign"=>$sign,"timestamp"=>$timestamp);

$token = new TGMToken();

$token->check($param);

?>
