<?php
namespace App\Patrols\Checkpoints;

use App\Accounts\Account;
use App\Locations\Doors\Door;
use App\Patrols\Patrol;

class EloquentCheckpointRepository implements CheckpointRepository
{
    /**
     * @var \App\Patrols\Checkpoints\EloquentCheckpoint
     */
    private $checkpoint;

    public function __construct(EloquentCheckpoint $checkpoint)
    {
        $this->checkpoint = $checkpoint;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param \App\Patrols\Patrol $patrol
     * @param \App\Locations\Doors\Door $door
     * @param array $values
     * @return \App\Patrols\Checkpoints\Checkpoint
     */
    public function create(Account $account, Patrol $patrol, Door $door, array $values)
    {
        $checkpoint = new EloquentCheckpoint($values);
        $checkpoint->account_id = $account->id();
        $checkpoint->door_id = $door->id();
        $checkpoint->patrol_id = $patrol->id();

        $checkpoint->save();

        return $checkpoint;
    }

    /**
     * @param \App\Patrols\Checkpoints\Checkpoint $checkpoint
     * @param array $values
     * @return \App\Patrols\Checkpoints\Checkpoint
     */
    public function update(Checkpoint $checkpoint, array $values)
    {
        if (array_key_exists('name', $values)) {
            $checkpoint->name = $values['name'];
        }

        if (array_key_exists('description', $values)) {
            $checkpoint->description = $values['description'];
        }

        $checkpoint->save();

        return $checkpoint;
    }

    /**
     * @param \App\Patrols\Checkpoints\Checkpoint $checkpoint
     */
    public function delete(Checkpoint $checkpoint)
    {
        $checkpoint->delete();
    }

    /**
     * @param int $id
     * @return \App\Patrols\Checkpoints\Checkpoint|null
     */
    public function find($id)
    {
        return $this->checkpoint->where('id', $id)->first();
    }

    /**
     * @param \App\Patrols\Patrol $patrol
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByPatrolPaginated(Patrol $patrol, $limit = 10)
    {
        return $this->checkpoint
            ->where('patrol_id', $patrol->id())
            ->paginate($limit);
    }
}
