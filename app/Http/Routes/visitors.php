<?php

Route::get('/visitors', ['as' => 'visitors', 'uses' => 'VisitorController@index']);
Route::get('/visitors/create', ['as' => 'visitors.create', 'uses' => 'VisitorController@create']);
Route::get('/visitors/edit/{visit}', ['as' => 'visitors.edit', 'uses' => 'VisitorController@edit']);
