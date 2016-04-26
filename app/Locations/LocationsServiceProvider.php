<?php
namespace App\Locations;

use App\Locations\Buildings\BuildingRepository;
use App\Locations\Buildings\EloquentBuilding;
use App\Locations\Buildings\EloquentBuildingRepository;
use Illuminate\Support\ServiceProvider;

class LocationsServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(BuildingRepository::class, function() {
            return new EloquentBuildingRepository(new EloquentBuilding());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            BuildingRepository::class,
        ];
    }
}
