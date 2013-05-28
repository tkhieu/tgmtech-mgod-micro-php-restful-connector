<?php

require_once './TGMToken.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$key = "GuN4fM2NjQE6wgpEwrRhhqX2kajTsnKDEUZ7TS9J75Jus5XMhK";
$secret = "cjpmrJG7nRqD9NDRFRKJSwNZKZybKe69Vt8Qd8cxmCEMGxSzPvGd4u4ftUDvZSWqV9hPmcWDytmb3UxshTKgGMUB72jaed7BBPRr";

$timestamp = time();

$temp = $key.  md5($timestamp).$secret;
$sign = md5($temp);

$param = array("key"=>$key,"sign"=>$sign,"timestamp"=>$timestamp);

$token = new TGMToken();

$token->check($param);

?>
