<?php

Route::get('/keys', ['as' => 'keys.index', 'uses' => 'KeyController@index']);
Route::get('/keys/create', ['as' => 'keys.create', 'uses' => 'KeyController@create']);
Route::get('/keys/edit/{key}', ['as' => 'keys.edit', 'uses' => 'KeyController@edit']);
