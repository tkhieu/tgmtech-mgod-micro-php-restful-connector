<?php

require_once './TGMToken.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$key = "tgm-mgod";
$secret = "cjpmrJG7nRqD9NDRFRKJSwNZKZybKe69Vt8Qd8cxmCEMGxSzPvGd4u4ftUDvZSWqV9hPmcWDytmb3UxshTKgGMUB72jaed7BBPRr";

$timestamp = "";

 echo $temp = md5($key.$timestamp).  md5($timestamp). md5($secret.$timestamp);
 echo "<br />";
echo $sign = md5($temp);
echo "<br />";

$param = array("key"=>$key,"sign"=>$sign,"timestamp"=>$timestamp);

$token = new TGMToken();

echo $token->check($param);

?>
