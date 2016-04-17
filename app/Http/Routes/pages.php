<?php

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);
Route::get('/test', ['uses' => 'PagesController@test']);
