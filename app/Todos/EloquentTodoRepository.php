<?php
namespace App\Todos;

use App\Accounts\Account;
use App\Users\User;
use Carbon\Carbon;

class EloquentTodoRepository implements TodoRepository
{
    /**
     * @var \App\Todos\EloquentTodo
     */
    private $todo;

    public function __construct(EloquentTodo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param \App\Users\User $user
     * @param array $values
     * @return \App\Todos\Todo
     */
    public function create(Account $account, User $user, array $values)
    {
        $todo = new EloquentTodo();
        $todo->name = $values['name'];
        $todo->date = Carbon::createFromFormat('d/m/Y', $values['date']);
        $todo->finished = false;
        $todo->account_id = $account->id();
        $todo->user_id = $user->id();

        $todo->save();

        return $todo;
    }

    /**
     * @param \App\Todos\Todo $todo
     * @param array $values
     * @return \App\Todos\Todo
     */
    public function update(Todo $todo, array $values)
    {
        if (array_key_exists('name', $values)) {
            $todo->name = $values['name'];
        }

        if (array_key_exists('date', $values)) {
            $todo->date = Carbon::createFromFormat('d/m/Y', $values['date']);
        }

        if (array_key_exists('finished', $values)) {
            $todo->finished = true;
        }

        $todo->save();

        return $todo;
    }

    /**
     * @param \App\Todos\Todo $todo
     */
    public function delete(Todo $todo)
    {
        $todo->delete();
    }

    /**
     * @param int $id
     * @return \App\Todos\Todo|null
     */
    public function find($id)
    {
        return $this->todo->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param \App\Users\User $user
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountAndUserPaginated(Account $account, User $user, $limit = 10)
    {
        return $this->todo
            ->where('account_id', $account->id())
            ->where('user_id', $user->id())
            ->paginate($limit);
    }
}
