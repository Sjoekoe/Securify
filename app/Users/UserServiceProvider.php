<?php
namespace App\Users;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserRepository::class, function() {
            return new EloquentUserRepository(new EloquentUser());
        });
    }
}
