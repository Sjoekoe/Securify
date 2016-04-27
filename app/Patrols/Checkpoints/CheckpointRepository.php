<?php
namespace App\Patrols\Checkpoints;

use App\Accounts\Account;
use App\Locations\Doors\Door;
use App\Patrols\Patrol;

interface CheckpointRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param \App\Patrols\Patrol $patrol
     * @param \App\Locations\Doors\Door $door
     * @param array $values
     * @return \App\Patrols\Checkpoints\Checkpoint
     */
    public function create(Account $account, Patrol $patrol, Door $door, array $values);

    /**
     * @param \App\Patrols\Checkpoints\Checkpoint $checkpoint
     * @param array $values
     * @return \App\Patrols\Checkpoints\Checkpoint
     */
    public function update(Checkpoint $checkpoint, array $values);
    
    /**
     * @param \App\Patrols\Checkpoints\Checkpoint $checkpoint
     */
    public function delete(Checkpoint $checkpoint);
    
    /**
     * @param int $id
     * @return \App\Patrols\Checkpoints\Checkpoint|null
     */
    public function find($id);
    
    /**
     * @param \App\Patrols\Patrol $patrol
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByPatrolPaginated(Patrol $patrol, $limit = 10);
}
