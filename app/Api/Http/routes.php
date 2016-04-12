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

        $api->group(['namespace' => 'Accounts\\', 'prefix' => 'accounts'], function (Router $api) {
            $api->get('/', ['as' => 'accounts.index', 'uses' => 'AccountController@index']);
            $api->post('/', ['as' => 'accounts.store', 'uses' => 'AccountController@store']);
            $api->get('/{account}', ['as' => 'accounts.show', 'uses' => 'AccountController@show']);
            $api->put('/{account}', ['as' => 'accounts.update', 'uses' => 'AccountController@update']);
            $api->delete('/{account}', ['as' => 'accounts.delete', 'uses' => 'AccountController@delete']);
        });
    });
});
