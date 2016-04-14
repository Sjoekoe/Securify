<?php

Route::get('/accounts', ['as' => 'accounts', 'uses' => 'AccountController@index']);
Route::get('/accounts/{account}/login', ['as' => 'accounts.login', 'uses' => 'AccountController@login']);

Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AccountController@dashboard']);
