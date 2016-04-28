<?php
namespace App\Providers;

use App\Accounts\AccountRouteBinding;
use App\Companies\CompanyRouteBinding;
use App\Employees\EmployeeRouteBinding;
use App\Incidents\IncidentRouteBinding;
use App\Items\Groups\ItemGroupRouteBinding;
use App\Items\ItemRouteBinding;
use App\Keys\KeyRouteBinding;
use App\Locations\Buildings\BuildingRouteBinding;
use App\Locations\Doors\DoorRouteBinding;
use App\Patrols\Checkpoints\CheckpointRouteBinding;
use App\Patrols\PatrolRouteBinding;
use App\Tasks\TaskRouteBinding;
use App\Teams\TeamRouteBinding;
use App\Visitors\VisitorRouteBinding;
use App\Visits\VisitRouteBinding;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Users\UserRouteBinding;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->bind('account', AccountRouteBinding::class);
        $router->bind('building', BuildingRouteBinding::class);
        $router->bind('checkpoint', CheckpointRouteBinding::class);
        $router->bind('company', CompanyRouteBinding::class);
        $router->bind('door', DoorRouteBinding::class);
        $router->bind('employee', EmployeeRouteBinding::class);
        $router->bind('incident', IncidentRouteBinding::class);
        $router->bind('item', ItemRouteBinding::class);
        $router->bind('itemGroup', ItemGroupRouteBinding::class);
        $router->bind('key', KeyRouteBinding::class);
        $router->bind('patrol', PatrolRouteBinding::class);
        $router->bind('task', TaskRouteBinding::class);
        $router->bind('team', TeamRouteBinding::class);
        $router->bind('user', UserRouteBinding::class);
        $router->bind('visit', VisitRouteBinding::class);
        $router->bind('visitor', VisitorRouteBinding::class);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $this->mapWebRoutes($router);

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
