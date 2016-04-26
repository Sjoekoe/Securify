<?php
namespace App\Api\Locations\Doors;

use App\Api\Accounts\AccountTransformer;
use App\Api\Keys\KeyTransformer;
use App\Api\Locations\Buildings\BuildingTransformer;
use App\Locations\Doors\Door;
use League\Fractal\TransformerAbstract;

class DoorTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
        'buildingRelation',
        'keyRelation',
    ];

    /**
     * @param \App\Locations\Doors\Door $door
     * @return array
     */
    public function transform(Door $door)
    {
        return [
            'id' => $door->id(),
            'name' => $door->name(),
            'description' => $door->description(),
        ];
    }

    /**
     * @param \App\Locations\Doors\Door $door
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Door $door)
    {
        return $this->item($door->account(), new AccountTransformer());
    }

    /**
     * @param \App\Locations\Doors\Door $door
     * @return \League\Fractal\Resource\Item
     */
    public function includeBuildingRelation(Door $door)
    {
        return $this->item($door->building(), new BuildingTransformer());
    }

    /**
     * @param \App\Locations\Doors\Door $door
     * @return \League\Fractal\Resource\Item
     */
    public function includeKeyRelation(Door $door)
    {
        return $this->item($door->key(), new KeyTransformer());
    }
}
