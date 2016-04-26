<?php
namespace App\Api\Locations\Buildings;

use App\Api\Accounts\AccountTransformer;
use App\Locations\Buildings\Building;
use League\Fractal\TransformerAbstract;

class BuildingTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
    ];

    /**
     * @param \App\Locations\Buildings\Building $building
     * @return array
     */
    public function transform(Building $building)
    {
        return [
            'id' => $building->id(),
            'name' => $building->name(),
        ];
    }

    /**
     * @param \App\Locations\Buildings\Building $building
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Building $building)
    {
        return $this->item($building->account(), new AccountTransformer());
    }
}
