<?php

use App\Core\Routing\Route;
use App\Middleware\BlockFirefox;
use App\Middleware\BlockIE;

#--------- view -------------
Route::get('/', function () {
    view('Home.index');
});
#-------------------------------------------------

#--------- todo -------------
Route::post('/todo/list', 'TodoController@list', [BlockIE::class, BlockFirefox::class]);
Route::get('/todo/add', 'TodoController@add');
Route::get('/todo/remove', 'TodoController@remove');
#-------------------------------------------------


Route::get('/post/{slug}', 'PostController@single');
Route::get('/post/{slug}/comment/{c_id}', 'PostController@comment');
