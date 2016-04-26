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

        $api->group(['namespace' => 'Teams\\', 'prefix' => 'users/{user}/teams'], function (Router $api) {
            $api->get('/', ['as' => 'users.teams.index', 'uses' => 'TeamController@index']);
            $api->get('/{team}', ['as' => 'users.teams.show', 'uses' => 'TeamController@show']);
            $api->delete('/{team}', ['as' => 'users.teams.delete', 'uses' => 'TeamController@delete']);
        });

        $api->group(['middleware' => 'api.auth', 'namespace' => 'Accounts\\', 'prefix' => 'accounts'], function (Router $api) {
            $api->get('/', ['as' => 'accounts.index', 'uses' => 'AccountController@index']);
            $api->post('/', ['as' => 'accounts.store', 'uses' => 'AccountController@store']);
            $api->get('/{account}', ['as' => 'accounts.show', 'uses' => 'AccountController@show']);
            $api->put('/{account}', ['as' => 'accounts.update', 'uses' => 'AccountController@update']);
            $api->delete('/{account}', ['as' => 'accounts.delete', 'uses' => 'AccountController@delete']);

            $api->group(['namespace' => 'Employees\\', 'prefix' => '{account}/employees'], function(Router $api) {
                $api->get('/', ['as' => 'accounts.employees.index', 'uses' => 'EmployeeController@index']);
                $api->post('/', ['as' => 'accounts.employees.store', 'uses' => 'EmployeeController@store']);
                $api->get('/{employee}', ['as' => 'accounts.employees.show', 'uses' => 'EmployeeController@show']);
                $api->put('/{employee}', ['as' => 'accounts.employees.update', 'uses' => 'EmployeeController@update']);
                $api->delete('/{employee}', ['as' => 'accounts.employees.delete', 'uses' => 'EmployeeController@delete']);
            });

            $api->group(['namespace' => 'Visitors\\', 'prefix' => '{account}/visitors'], function (Router $api) {
                $api->get('/', ['as' => 'accounts.visitors.index', 'uses' => 'VisitorController@index']);
                $api->post('/', ['as' => 'accounts.visitors.store', 'uses' => 'VisitorController@store']);
                $api->get('/{visitor}', ['as' => 'accounts.visitors.show', 'uses' => 'VisitorController@show']);
                $api->put('/{visitor}', ['as' => 'accounts.visitors.update', 'uses' => 'VisitorController@update']);
                $api->delete('/{visitor}', ['as' => 'accounts.visitors.delete', 'uses' => 'VisitorController@delete']);
            });

            $api->group(['namespace' => 'Companies\\', 'prefix' => '{account}/companies'], function (Router $api) {
                $api->get('/', ['as' => 'accounts.companies.index', 'uses' => 'CompanyController@index']);
                $api->post('/', ['as' => 'accounts.companies.store', 'uses' => 'CompanyController@store']);
                $api->get('/{company}', ['as' => 'accounts.companies.show', 'uses' => 'CompanyController@show']);
                $api->put('/{company}', ['as' => 'accounts.companies.update', 'uses' => 'CompanyController@update']);
                $api->delete('/{company}', ['as' => 'accounts.companies.delete', 'uses' => 'CompanyController@delete']);
            });

            $api->group(['namespace' => 'Visits\\', 'prefix' => '{account}/visits'], function (Router $api) {
                $api->get('/', ['as' => 'accounts.visits.index', 'uses' => 'VisitController@index']);
                $api->get('/{visit}', ['as' => 'accounts.visits.show', 'uses' => 'VisitController@show']);
                $api->put('/{visit}', ['as' => 'accounts.visits.update', 'uses' => 'VisitController@update']);
                $api->delete('/{visit}', ['as' => 'accounts.visits.delete', 'uses' => 'VisitController@delete']);
            });

            $api->group(['namespace' => 'Visitations\\', 'prefix' => '{account}/visitations'], function(Router $api) {
                $api->post('/', ['as' => 'accounts.visitations.store', 'uses' => 'VisitationController@store']);
                $api->put('/{visit}', ['as' => 'accounts.visitations.update', 'uses' => 'VisitationController@update']);
            });

            $api->group(['namespace' => 'Keys\\', 'prefix' => '{account}/keys'], function (Router $api) {
                $api->get('/', ['as' => 'accounts.keys.index', 'uses' => 'KeyController@index']);
                $api->post('/', ['as' => 'accounts.keys.store', 'uses' => 'KeyController@store']);
                $api->get('/{key}', ['as' => 'accounts.keys.show', 'uses' => 'KeyController@show']);
                $api->put('/{key}', ['as' => 'accounts.keys.update', 'uses' => 'KeyController@update']);
                $api->delete('/{key}', ['as' => 'accounts.keys.delete', 'uses' => 'KeyController@delete']);
            });

            $api->group(['namespace' => 'Incidents\\', 'prefix' => '{account}/incidents'], function(Router $api) {
                $api->get('/', ['as' => 'accounts.incidents.index', 'uses' => 'IncidentController@index']);
                $api->post('/', ['as' => 'accounts.incidents.store', 'uses' => 'IncidentController@store']);
                $api->get('/{incident}', ['as' => 'accounts.incidents.show', 'uses' => 'IncidentController@show']);
                $api->put('/{incident}', ['as' => 'accounts.incidents.update', 'uses' => 'IncidentController@update']);
                $api->delete('/{incident}', ['as' => 'accounts.incidents.delete', 'uses' => 'IncidentController@delete']);
            });
        });
    });
});
