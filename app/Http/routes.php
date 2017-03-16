<?php

Route::get('/', 'HomeController@index');
Route::auth();
Route::get('/home', 'HomeController@index');

Route::post('score/create', 'ScoreController@store');
Route::get('score/create', 'HomeController@index');

Route::get('/users', 'UserController@index');
Route::get('/user/{user_id}/show', 'UserController@show');



