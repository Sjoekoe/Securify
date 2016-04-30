<?php
namespace App\Vehicles;

use App\Accounts\Account;

class EloquentVehicleRepository implements VehicleRepository
{
    /**
     * @var \App\Vehicles\EloquentVehicle
     */
    private $vehicle;

    public function __construct(EloquentVehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Vehicles\Vehicle
     */
    public function create(Account $account, array $values)
    {
        $vehicle = new EloquentVehicle($values);
        $vehicle->account_id = $account->id();

        $vehicle->save();

        return $vehicle;
    }

    /**
     * @param \App\Vehicles\Vehicle $vehicle
     * @param array $values
     * @return \App\Vehicles\Vehicle
     */
    public function update(Vehicle $vehicle, array $values)
    {
        if (array_key_exists('license_plate', $values)) {
            $vehicle->license_plate = $values['license_plate'];
        }

        if (array_key_exists('type', $values)) {
            $vehicle->type = $values['type'];
        }

        $vehicle->save();

        return $vehicle;
    }

    /**
     * @param \App\Vehicles\Vehicle $vehicle
     */
    public function delete(Vehicle $vehicle)
    {
        $vehicle->delete();
    }

    /**
     * @param int $id
     * @return \App\Vehicles\Vehicle|null
     */
    public function find($id)
    {
        return $this->vehicle->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \App\Vehicles\Vehicle
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->vehicle
            ->where('account_id', $account->id())
            ->paginate($limit);
    }
}
