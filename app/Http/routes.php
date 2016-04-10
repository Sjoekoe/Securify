<?php

Route::group(['namespace' => 'Api'], function () {
    require __DIR__ . '/../Api/Http/routes.php';
});

Route::get('/', function () {
    return view('welcome');
});
