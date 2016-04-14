<?php
Route::group(['namespace' => 'Accounts'], function() {
    require __DIR__ . '/Routes/accounts.php';
});

Route::group(['namespace' => 'Api'], function () {
    require __DIR__ . '/../Api/Http/routes.php';
});

Route::group(['namespace' => 'Auth'], function() {
    require __DIR__ . '/Routes/auth.php';
});

Route::group(['namespace' => 'Pages'], function() {
    require __DIR__ . '/Routes/pages.php';
});

Route::group(['namespace' => 'Users'], function() {
    require __DIR__ . '/Routes/settings.php';
});

