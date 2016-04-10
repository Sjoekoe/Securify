<?php
use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function(Router $api) {
    $api->group(['namespace' => 'App\\Api\\Http\\Controllers\\'], function (Router $api) {
        $api->get('/users', ['as' => 'users.index', 'uses' => 'UserController@index']);
        $api->post('/users', ['as' => 'users.create', 'uses' => 'UserController@store']);
        $api->get('/users/{user}', ['as' => 'users.show', 'uses' => 'UserController@show']);
        $api->put('/users/{user}', ['as' => 'users.update', 'uses' => 'UserController@update']);
        $api->delete('/users/{user}', ['as' => 'users.delete', 'uses' => 'UserController@delete']);
    });
});
