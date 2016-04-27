<?php
namespace App\Api\Tasks;

use App\Api\Accounts\AccountTransformer;
use App\Tasks\Task;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
    ];

    /**
     * @param \App\Tasks\Task $task
     * @return array
     */
    public function transform(Task $task)
    {
        return [
            'id' => $task->id(),
            'name' => $task->name(),
            'description' => $task->description(),
            'expected_start' => $task->expectedStart()->toIso8601String(),
            'expected_end' => $task->expectedEnd()->toIso8601String(),
            'finished' => $task->finished() ? $task->finished()->toIso8601String() : null,
        ];
    }

    /**
     * @param \App\Tasks\Task $task
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Task $task)
    {
        return $this->item($task->account(), new AccountTransformer());
    }
}
