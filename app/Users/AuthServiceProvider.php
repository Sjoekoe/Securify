<?php
namespace App\Users;

use Illuminate\Auth\SessionGuard;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['auth']->extend('eloquent', function ($app) {
            $users = $app[EloquentUserRepository::class];
            $userProvider = new EloquentUserProvider($app['hash'], $users);
            return new SessionGuard($userProvider, $app['session.store']);
        });
    }

    public function register()
    {
    }
}
