<?php
namespace App\Accounts;

use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(AccountRepository::class, function() {
            return new EloquentAccountRepository(new EloquentAccount());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            AccountRepository::class,
        ];
    }
}
