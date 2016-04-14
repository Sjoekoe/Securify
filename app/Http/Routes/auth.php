<?php

Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
Route::post('/login', ['as' => 'login.post', 'uses' => 'AuthController@postlogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
