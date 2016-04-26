<?php
namespace App\Patrols;

use Illuminate\Support\ServiceProvider;

class PatrolServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(PatrolRepository::class, function() {
            return new EloquentPatrolRepository(new EloquentPatrol());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            PatrolRepository::class,
        ];
    }
}
