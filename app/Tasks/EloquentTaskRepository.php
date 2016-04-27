<?php
namespace App\Tasks;

use App\Accounts\Account;
use Carbon\Carbon;

class EloquentTaskRepository implements TaskRepository
{
    /**
     * @var \App\Tasks\EloquentTask
     */
    private $task;

    public function __construct(EloquentTask $task)
    {
        $this->task = $task;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Tasks\EloquentTask
     */
    public function create(Account $account, array $values)
    {
        $task = new EloquentTask();
        $task->name = $values['name'];
        $task->description = array_get($values, 'description');
        $task->expected_start = Carbon::createFromFormat('d-m-Y - H:i', $values['expected_start']);
        $task->expected_end = Carbon::createFromFormat('d-m-Y - H:i', $values['expected_end']);
        $task->account_id = $account->id();
        $task->finished = null;

        $task->save();

        return $task;
    }

    /**
     * @param \App\Tasks\Task $task
     * @param array $values
     * @return \App\Tasks\Task
     */
    public function update(Task $task, array $values)
    {
        if (array_key_exists('name', $values)) {
            $task->name = $values['name'];
        }

        if (array_key_exists('description', $values)) {
            $task->description = $values['decription'];
        }

        if (array_key_exists('expected_start', $values)) {
            $task->expected_start = Carbon::createFromFormat('d-m-Y - H:i', $values['expected_start']);
        }

        if (array_key_exists('expected_end', $values)) {
            $task->expected_end = Carbon::createFromFormat('d-m-Y - H:i', $values['expected_end']);
        }

        if (array_key_exists('finished', $values)) {
            $task->finished = Carbon::createFromFormat('d-m-Y - H:i', $values['finished']);
        }

        $task->save();

        return $task;
    }

    /**
     * @param \App\Tasks\Task $task
     */
    public function delete(Task $task)
    {
        $task->delete();
    }

    /**
     * @param int $id
     * @return \App\Tasks\Task|null
     */
    public function find($id)
    {
        return $this->task->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->task
            ->where('account_id', $account->id())
            ->paginate($limit);
    }
}
