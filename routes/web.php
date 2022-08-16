<?php

use App\Core\Routing\Route;

Route::add('get', '/sss');

Route::add(['get','post','put'], '/', function() {
    echo 'Welcome';
});

Route::add('post', '/saveForm', function() {
    echo 'Save ok';
});

Route::get('/a', function() {
    echo 'Home';
});

Route::put('/b', ['Controller', 'Method']);

Route::get('/c', 'HomeController@index');