<?php

/*
 * This file is part of the Predis package.
 *
 * (c) Daniele Alessandri <suppakilla@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once './Predis/Autoloader.php';
require_once "./Slim/Slim.php";
require_once "./idiorm.php";
require_once "./rb.php";


Predis\Autoloader::register();
\Slim\Slim::registerAutoloader();



?>