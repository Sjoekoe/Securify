<?php
namespace App\Vehicles;

use Illuminate\Support\ServiceProvider;

class VehicleServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(VehicleRepository::class, function() {
            return new EloquentVehicleRepository(new EloquentVehicle());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            VehicleRepository::class,
        ];
    }
}
