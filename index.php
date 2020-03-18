<?php

session_start();

use App\Models\Router;
use App\Models\View;

include __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/config/const.php';
include __DIR__ . '/config/db.php';
include __DIR__ . '/config/helper.php';

$router = new Router(ROOT_DIR . 'config/routes.php');
$router->run();
