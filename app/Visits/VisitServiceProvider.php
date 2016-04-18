<?php
namespace App\Visits;

use Illuminate\Support\ServiceProvider;

class VisitServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(VisitRepository::class, function() {
            return new EloquentVisitRepository(new EloquentVisit());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            VisitRepository::class,
        ];
    }
}
