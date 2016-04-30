<?php
namespace App\Api\Vehicles;

use App\Api\Accounts\AccountTransformer;
use App\Vehicles\Vehicle;
use League\Fractal\TransformerAbstract;

class VehicleTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
    ];
    
    /**
     * @param \App\Vehicles\Vehicle $vehicle
     * @return array
     */
    public function transform(Vehicle $vehicle)
    {
        return [
            'id' => $vehicle->id(),
            'type' => $vehicle->type(),
            'license_plate' => $vehicle->licensePLate(),
        ];
    }

    /**
     * @param \App\Vehicles\Vehicle $vehicle
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Vehicle $vehicle)
    {
        return $this->item($vehicle->account(), new AccountTransformer());
    }
}
