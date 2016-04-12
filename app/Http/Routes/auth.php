<?php

Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
