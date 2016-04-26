<?php
namespace App\Locations\Buildings;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class BuildingRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Locations\Buildings\BuildingRepository
     */
    private $buildings;

    public function __construct(BuildingRepository $buildings)
    {
        $this->buildings = $buildings;
    }

    /**
     * @param int $id
     * @return \App\Locations\Buildings\Building|null
     */
    public function find($id)
    {
        return $this->buildings->find($id);
    }
}
