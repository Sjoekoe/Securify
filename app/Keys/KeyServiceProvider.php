<?php
namespace App\Keys;

use Illuminate\Support\ServiceProvider;

class KeyServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(KeyRepository::class, function() {
            return new EloquentKeyRepository(new EloquentKey());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            KeyRepository::class,
        ];
    }
}
