<?php
namespace App\Auth;

use App\Teams\EloquentTeam;
use App\Teams\EloquentTeamRepository;
use App\Users\EloquentUser;
use App\Users\EloquentUserRepository;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require __DIR__ . '/helpers.php';

        $this->app['auth']->extend('securify', function($app, $name, array $config) {
            $guard = new Guard($name, $app['auth']->createUserProvider($config['provider']), $app['session.store']);
            $guard->setCookieJar($app['cookie']);
            $guard->setDispatcher($app['events']);
            $guard->setRequest($app->refresh('request', $guard, 'setRequest'));

            return $guard;
        });

        $this->app['auth']->provider('securify', function($app) {
            return new EloquentUserProvider(
                $app[Hasher::class],
                new EloquentUserRepository(new EloquentUser()),
                new EloquentTeamRepository(new EloquentTeam())
            );
        });
    }

    public function register()
    {
    }
}
