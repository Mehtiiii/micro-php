<?php

include './bootstrap/init.php';

$userModel = new App\Models\User();
var_dump($userModel->delete(['name' => 'asdasd']));