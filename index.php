<?php

use App\Core\Routing\Router;

include './bootstrap/init.php';

// var_dump(App\Core\Routing\Route::routes());

$router = new Router();
$router->run();