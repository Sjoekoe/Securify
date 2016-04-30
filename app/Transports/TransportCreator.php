<?php
namespace App\Transports;

use App\Accounts\Account;
use App\Database\CanMakeDatabaseTransactions;
use App\Database\TransactionManager;
use App\Vehicles\VehicleRepository;

class TransportCreator
{
    use CanMakeDatabaseTransactions;

    /**
     * @var \App\Vehicles\VehicleRepository
     */
    private $vehicles;

    /**
     * @var \App\Transports\TransportRepository
     */
    private $transports;

    public function __construct(
        TransactionManager $manager,
        VehicleRepository $vehicles,
        TransportRepository $transports
    ) {
        $this->transactionManager = $manager;
        $this->vehicles = $vehicles;
        $this->transports = $transports;
    }

    public function create(Account $account, array $values)
    {
        return $this->transaction(function() use ($account, $values){
            $vehicle = $this->vehicles->find($values['vehicle_id']);
            $transport = $this->transports->create($account, $vehicle, $values);

            return $transport;
        });
    }
}
