<?php
namespace App\Locations\Doors;

use App\Accounts\Account;
use App\Database\CanMakeDatabaseTransactions;
use App\Database\TransactionManager;
use App\Keys\KeyRepository;
use App\Locations\Buildings\BuildingRepository;

class DoorCreator
{
    use CanMakeDatabaseTransactions;

    /**
     * @var \App\Locations\Buildings\BuildingRepository
     */
    private $buildings;

    /**
     * @var \App\Keys\KeyRepository
     */
    private $keys;

    /**
     * @var \App\Locations\Doors\DoorRepository
     */
    private $doors;

    public function __construct(
        TransactionManager $transactionManager,
        BuildingRepository $buildings,
        KeyRepository $keys,
        DoorRepository $doors
    ) {
        $this->transactionManager = $transactionManager;
        $this->buildings = $buildings;
        $this->keys = $keys;
        $this->doors = $doors;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Locations\Doors\Door
     */
    public function create(Account $account, array $values)
    {
        return $this->transaction(function() use ($account, $values) {
            $building = $this->fetchBuilding($values['building_id']);
            $key = $this->fetchKey($values['key_id']);

            return $this->doors->create($account, $building, $key, $values);
        });
    }

    /**
     * @param int $id
     * @return \App\Locations\Buildings\Building|null
     */
    private function fetchBuilding($id)
    {
        return $this->buildings->find($id);
    }

    /**
     * @param $id
     * @return \App\Keys\Key|null
     */
    private function fetchKey($id)
    {
        return $this->keys->find($id);
    }
}
