<?php
namespace App\Vehicles;

use App\Accounts\Account;

interface VehicleRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Vehicles\Vehicle
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Vehicles\Vehicle $vehicle
     * @param array $values
     * @return \App\Vehicles\Vehicle
     */
    public function update(Vehicle $vehicle, array $values);
    
    /**
     * @param \App\Vehicles\Vehicle $vehicle
     */
    public function delete(Vehicle $vehicle);
    
    /**
     * @param int $id
     * @return \App\Vehicles\Vehicle|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \App\Vehicles\Vehicle
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
