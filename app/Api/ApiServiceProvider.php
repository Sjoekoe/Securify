<?php
namespace App\Api;

use Dingo\Api\Dispatcher;
use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    public function register()
    {
        $this->app->bind(Api::class, function ($app) {
            return new DingoApi(
                $app[Dispatcher::class],
                $app[UrlGenerator::class],
                $app['config']['api']['version'],
                $app[AuthManager::class]->user()
            );
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            Api::class,
        ];
    }
}
