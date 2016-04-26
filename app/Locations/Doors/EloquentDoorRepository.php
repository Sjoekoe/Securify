<?php
namespace App\Locations\Doors;

use App\Accounts\Account;
use App\Keys\Key;
use App\Locations\Buildings\Building;

class EloquentDoorRepository implements DoorRepository
{
    /**
     * @var \App\Locations\Doors\EloquentDoor
     */
    private $door;

    public function __construct(EloquentDoor $door)
    {
        $this->door = $door;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param \App\Locations\Buildings\Building $building
     * @param \App\Keys\Key $key
     * @param array $values
     * @return \App\Locations\Doors\Door
     */
    public function create(Account $account, Building $building, Key $key, array $values)
    {
        $door = new EloquentDoor($values);
        $door->account_id = $account->id();
        $door->building_id = $building->id();
        $door->key_id = $key->id();

        $door->save();

        return $door;
    }

    /**
     * @param \App\Locations\Doors\Door $door
     * @param array $values
     * @return \App\Locations\Doors\Door
     */
    public function update(Door $door, array $values)
    {
        if (array_key_exists('name', $values)) {
            $door->name = $values['name'];
        }

        if (array_key_exists('description', $values)) {
            $door->description = $values['description'];
        }
        
        $door->save();

        return $door;
    }

    /**
     * @param \App\Locations\Doors\Door $door
     */
    public function delete(Door $door)
    {
        $door->delete();
    }

    /**
     * @param int $id
     * @return \App\Locations\Doors\Door|null
     */
    public function find($id)
    {
        return $this->door->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->door
            ->where('account_id', $account->id())
            ->paginate($limit);
    }
}
