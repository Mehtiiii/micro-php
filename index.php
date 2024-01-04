<?php

use App\Models\user;

include './bootstrap/init.php';

$user = (new user(6));
$user->email = 'd3ntyx@yahoo.com';
$user->save();
// var_dump($user);