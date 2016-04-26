<?php
namespace App\Locations\Buildings;

use App\Accounts\Account;

interface BuildingRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Locations\Buildings\Building
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Locations\Buildings\Building $building
     * @param array $values
     * @return \App\Locations\Buildings\Building
     */
    public function update(Building $building, array $values);
    
    /**
     * @param \App\Locations\Buildings\Building $building
     */
    public function delete(Building $building);
    
    /**
     * @param int $id
     * @return \App\Locations\Buildings\Building|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
