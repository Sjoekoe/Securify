<?php
namespace App\Vehicles;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class VehicleRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Vehicles\VehicleRepository
     */
    private $vehicles;

    public function __construct(VehicleRepository $vehicles)
    {
        $this->vehicles = $vehicles;
    }

    /**
     * @param int $id
     * @return \App\Vehicles\Vehicle|null
     */
    public function find($id)
    {
        return $this->vehicles->Find($id);
    }
}
