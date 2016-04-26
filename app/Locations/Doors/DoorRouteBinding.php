<?php
namespace App\Locations\Doors;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class DoorRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Locations\Doors\DoorRepository
     */
    private $doors;

    public function __construct(DoorRepository $doors)
    {
        $this->doors = $doors;
    }

    /**
     * @param int|string $id
     * @return \App\Locations\Doors\Door|null
     */
    public function find($id)
    {
        return $this->doors->find($id);
    }
}
