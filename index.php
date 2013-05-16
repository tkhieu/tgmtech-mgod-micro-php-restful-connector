<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array('mode'=>'development', 'debug'=>'true'));
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});
$app->run();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
