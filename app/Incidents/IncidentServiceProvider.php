<?php
namespace App\Incidents;

use Illuminate\Support\ServiceProvider;

class IncidentServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(IncidentRepository::class, function() {
            return new EloquentIncidentRepository(new EloquentIncident());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            IncidentRepository::class,
        ];
    }
}
