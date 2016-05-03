<?php
namespace App\Api\Todos;

use App\Api\Accounts\AccountTransformer;
use App\Api\Users\UserTransformer;
use App\Todos\Todo;
use League\Fractal\TransformerAbstract;

class TodoTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
        'userRelation',
    ];

    /**
     * @param \App\Todos\Todo $todo
     * @return array
     */
    public function transform(Todo $todo)
    {
        return [
            'id' => $todo->id(),
            'name' => $todo->name(),
            'date' => $todo->date()->toIso8601String(),
            'finished' => (bool) $todo->finished(),
        ];
    }

    /**
     * @param \App\Todos\Todo $todo
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Todo $todo)
    {
        return $this->item($todo->account(), new AccountTransformer());
    }

    /**
     * @param \App\Todos\Todo $todo
     * @return \League\Fractal\Resource\Item
     */
    public function includeUserRelation(Todo $todo)
    {
        return $this->item($todo->user(), new UserTransformer());
    }
}
