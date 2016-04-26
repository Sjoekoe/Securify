<?php
namespace App\Locations;

use App\Locations\Buildings\BuildingRepository;
use App\Locations\Buildings\EloquentBuilding;
use App\Locations\Buildings\EloquentBuildingRepository;
use App\Locations\Doors\DoorRepository;
use App\Locations\Doors\EloquentDoor;
use App\Locations\Doors\EloquentDoorRepository;
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
        
        $this->app->singleton(DoorRepository::class, function() {
            return new EloquentDoorRepository(new EloquentDoor());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            BuildingRepository::class,
            DoorRepository::class,
        ];
    }
}
