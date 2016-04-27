<?php
namespace App\Api\Patrols\Checkpoints;

use App\Api\Accounts\AccountTransformer;
use App\Api\Locations\Doors\DoorTransformer;
use App\Api\Patrols\PatrolTransformer;
use App\Patrols\Checkpoints\Checkpoint;
use League\Fractal\TransformerAbstract;

class CheckpointTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
        'patrolRelation',
        'doorRelation',
    ];

    /**
     * @param \App\Patrols\Checkpoints\Checkpoint $checkpoint
     * @return array
     */
    public function transform(Checkpoint $checkpoint)
    {
        return [
            'id' => $checkpoint->id(),
            'name' => $checkpoint->name(),
            'description' => $checkpoint->description(),
        ];
    }

    /**
     * @param \App\Patrols\Checkpoints\Checkpoint $checkpoint
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Checkpoint $checkpoint)
    {
        return $this->item($checkpoint->account(), new AccountTransformer());
    }

    /**
     * @param \App\Patrols\Checkpoints\Checkpoint $checkpoint
     * @return \League\Fractal\Resource\Item
     */
    public function includePatrolRelation(Checkpoint $checkpoint)
    {
        return $this->item($checkpoint->patrol(), new PatrolTransformer());
    }

    /**
     * @param \App\Patrols\Checkpoints\Checkpoint $checkpoint
     * @return \League\Fractal\Resource\Item
     */
    public function includeDoorRelation(Checkpoint $checkpoint)
    {
        return $this->item($checkpoint->door(), new DoorTransformer());
    }
}
