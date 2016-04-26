<?php
namespace App\Locations\Doors;

use App\Accounts\Account;
use App\Keys\Key;
use App\Locations\Buildings\Building;

interface DoorRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param \App\Locations\Buildings\Building $building
     * @param \App\Keys\Key $key
     * @param array $values
     * @return \App\Locations\Doors\Door
     */
    public function create(Account $account, Building $building, Key $key, array $values);

    /**
     * @param \App\Locations\Doors\Door $door
     * @param array $values
     * @return \App\Locations\Doors\Door
     */
    public function update(Door $door, array $values);
    
    /**
     * @param \App\Locations\Doors\Door $door
     */
    public function delete(Door $door);
    
    /**
     * @param int $id
     * @return \App\Locations\Doors\Door|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
