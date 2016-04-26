<?php
namespace App\Locations\Buildings;

use App\Accounts\Account;

class EloquentBuildingRepository implements BuildingRepository
{
    /**
     * @var \App\Locations\Buildings\EloquentBuilding
     */
    private $building;

    public function __construct(EloquentBuilding $building)
    {
        $this->building = $building;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Locations\Buildings\Building
     */
    public function create(Account $account, array $values)
    {
        $building = new EloquentBuilding($values);
        $building->account_id = $account->id();

        $building->save();

        return $building;
    }

    /**
     * @param \App\Locations\Buildings\Building $building
     * @param array $values
     * @return \App\Locations\Buildings\Building
     */
    public function update(Building $building, array $values)
    {
        if (array_key_exists('name', $values)) {
            $building->name = $values['name'];
        }

        $building->save();

        return $building;
    }

    /**
     * @param \App\Locations\Buildings\Building $building
     */
    public function delete(Building $building)
    {
        $building->delete();
    }

    /**
     * @param int $id
     * @return \App\Locations\Buildings\Building|null
     */
    public function find($id)
    {
        return $this->building->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \App\Locations\Buildings\Building[]
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->building
            ->where('account_id', $account->id())
            ->paginate($limit);
    }
}
