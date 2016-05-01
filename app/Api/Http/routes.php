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

            $api->group(['namespace' => 'Locations\\'], function (Router $api) {
                $api->group(['namespace' => 'Buildings\\', 'prefix' => '{account}/buildings'], function (Router $api) {
                    $api->get('/', ['as' => 'accounts.buildings.index', 'uses' => 'BuildingController@index']);
                    $api->post('/', ['as' => 'accounts.buildings.store', 'uses' => 'BuildingController@store']);
                    $api->get('/{building}', ['as' => 'accounts.buildings.show', 'uses' => 'BuildingController@show']);
                    $api->put('/{building}', ['as' => 'accounts.buildings.update', 'uses' => 'BuildingController@update']);
                    $api->delete('/{building}', ['as' => 'accounts.buildings.delete', 'uses' => 'BuildingController@delete']);
                });

                $api->group(['namespace' => 'Doors\\', 'prefix' => '{account}/doors'], function (Router $api) {
                    $api->get('/', ['as' => 'account.doors.index', 'uses' => 'DoorController@index']);
                    $api->post('/', ['as' => 'account.doors.store', 'uses' => 'DoorController@store']);
                    $api->get('/{door}', ['as' => 'account.doors.show', 'uses' => 'DoorController@show']);
                    $api->put('/{door}', ['as' => 'account.doors.update', 'uses' => 'DoorController@update']);
                    $api->delete('/{door}', ['as' => 'account.doors.delete', 'uses' => 'DoorController@delete']);
                });
            });

            $api->group(['namespace' => 'Patrols\\', 'prefix' => '{account}/patrols'], function (Router $api) {
                $api->get('/', ['as' => 'account.patrols.index', 'uses' => 'PatrolController@index']);
                $api->post('/', ['as' => 'account.patrols.store', 'uses' => 'PatrolController@store']);
                $api->get('/{patrol}', ['as' => 'account.patrols.show', 'uses' => 'PatrolController@show']);
                $api->put('/{patrol}', ['as' => 'account.patrols.update', 'uses' => 'PatrolController@update']);
                $api->delete('/{patrol}', ['as' => 'account.patrols.delete', 'uses' => 'PatrolController@delete']);

                $api->group(['namespace' => 'CheckPoints\\', 'prefix' => '{patrol}/checkpoints'], function (Router $api) {
                    $api->get('/', ['as' => 'account.patrols.checkpoints.index', 'uses' => 'CheckpointController@index']);
                    $api->post('/', ['as' => 'account.patrols.checkpoints.store', 'uses' => 'CheckpointController@store']);
                    $api->get('/{checkpoint}', ['as' => 'account.patrols.checkpoints.show', 'uses' => 'CheckpointController@show']);
                    $api->put('/{checkpoint}', ['as' => 'account.patrols.checkpoints.update', 'uses' => 'CheckpointController@update']);
                    $api->delete('/{checkpoint}', ['as' => 'account.patrols.checkpoints.delete', 'uses' => 'CheckpointController@delete']);
                });
            });

            $api->group(['namespace' => 'Tasks\\', 'prefix' => '{account}/tasks'], function (Router $api) {
                $api->get('/', ['as' => 'accounts.tasks.index', 'uses' => 'TaskController@index']);
                $api->post('/', ['as' => 'accounts.tasks.store', 'uses' =>'TaskController@store']);
                $api->get('/{task}', ['as' => 'accounts.tasks.show', 'uses' => 'TaskController@show']);
                $api->put('/{task}', ['as' => 'accounts.tasks.update', 'uses' => 'TaskController@update']);
                $api->delete('/{task}', ['as' => 'accounts.tasks.delete', 'uses' => 'TaskController@delete']);
            });

            $api->group(['namespace' => 'Items\\'], function (Router $api) {
                $api->group(['prefix' => '{account}/items'], function (Router $api) {
                    $api->get('/', ['as' => 'accounts.items.index', 'uses' => 'ItemController@index']);
                    $api->post('/', ['as' => 'accounts.items.store', 'uses' => 'ItemController@store']);
                    $api->get('/{item}', ['as' => 'accounts.items.show', 'uses' => 'ItemController@show']);
                    $api->put('/{item}', ['as' => 'accounts.items.update', 'uses' => 'ItemController@update']);
                    $api->delete('/{item}', ['as' => 'accounts.items.delete', 'uses' => 'ItemController@delete']);
                });

                $api->group(['namespace' => 'Groups\\', 'prefix' => '{account}/item-groups'], function (Router $api) {
                    $api->get('/', ['as' => 'accounts.item_groups.index', 'uses' => 'ItemGroupController@index']);
                    $api->post('/', ['as' => 'accounts.item_groups.store', 'uses' => 'ItemGroupController@store']);
                    $api->get('/{itemGroup}', ['as' => 'accounts.item_groups.show', 'uses' => 'ItemGroupController@show']);
                    $api->put('/{itemGroup}', ['as' => 'accounts.item_groups.update', 'uses' => 'ItemGroupController@update']);
                    $api->delete('/{itemGroup}', ['as' => 'accounts.item_groups.delete', 'uses' => 'ItemGroupController@delete']);
                });
            });

            $api->group(['namespace' => 'Vehicles\\', 'prefix' => '{account}/vehicles'], function (Router $api) {
                $api->get('/', ['as' => 'accounts.vehicles.index', 'uses' => 'VehicleController@index']);
                $api->post('/', ['as' => 'accounts.vehicles.store', 'uses' => 'VehicleController@store']);
                $api->get('/{vehicle}', ['as' => 'accounts.vehicles.show', 'uses' => 'VehicleController@show']);
                $api->put('/{vehicle}', ['as' => 'accounts.vehicles.update', 'uses' => 'VehicleController@update']);
                $api->delete('/{vehicle}', ['as' => 'accounts.vehicles.delete', 'uses' => 'VehicleController@delete']);
            });

            $api->group(['namespace' => 'Transports\\', 'prefix' => '{account}/transports'], function (Router $api) {
                $api->get('/', ['as' => 'accounts.transports.index', 'uses' => 'TransportController@index']);
                $api->post('/', ['as' => 'accounts.transports.store', 'uses' => 'TransportController@store']);
                $api->get('/{transport}', ['as' => 'accounts.transports.show', 'uses' => 'TransportController@show']);
                $api->put('/{transport}', ['as' => 'accounts.transports.update', 'uses' => 'TransportController@update']);
                $api->delete('/{transport}', ['as' => 'accounts.transports.delete', 'uses' => 'TransportController@delete']);
            });

            $api->group(['namespace' => 'Documents\\', 'prefix' => '{account}/documents'], function (Router $api) {
                $api->get('/', ['as' => 'accounts.documents.index', 'uses' => 'DocumentController@index']);
                $api->post('/', ['as' => 'accounts.documents.store', 'uses' => 'DocumentController@store']);
                $api->get('/{document}', ['as' => 'accounts.documents.show', 'uses' => 'DocumentController@show']);
                $api->put('/{document}', ['as' => 'accounts.documents.update', 'uses' => 'DocumentController@update']);
                $api->delete('/{document}', ['as' => 'accounts.documents.delete', 'uses' => 'DocumentController@delete']);
            });
        });
    });
});
