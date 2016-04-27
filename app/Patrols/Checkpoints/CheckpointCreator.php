<?php
namespace App\Patrols\Checkpoints;

use App\Accounts\Account;
use App\Database\CanMakeDatabaseTransactions;
use App\Database\TransactionManager;
use App\Locations\Doors\DoorRepository;
use App\Patrols\Patrol;

class CheckpointCreator
{
    use CanMakeDatabaseTransactions;

    /**
     * @var \App\Locations\Doors\DoorRepository
     */
    private $doors;

    /**
     * @var \App\Patrols\Checkpoints\CheckpointRepository
     */
    private $checkpoints;

    public function __construct(
        TransactionManager $transactionManager, 
        DoorRepository $doors, 
        CheckpointRepository $checkpoints
    ) {
        $this->transactionManager = $transactionManager;
        $this->doors = $doors;
        $this->checkpoints = $checkpoints;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param \App\Patrols\Patrol $patrol
     * @param array $values
     * @return \App\Patrols\Checkpoints\Checkpoint
     */
    public function create(Account $account, Patrol $patrol, array $values)
    {
        return $this->transaction(function () use ($account, $patrol, $values) {
            $door = $this->doors->find($values['door_id']);
            $checkpoint = $this->checkpoints->create($account, $patrol, $door, $values);
            
            return $checkpoint;
        });
    }
}
