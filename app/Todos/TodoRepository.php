<?php
namespace App\Todos;

use App\Accounts\Account;
use App\Users\User;

interface TodoRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param \App\Users\User $user
     * @param array $values
     * @return \App\Todos\Todo
     */
    public function create(Account $account, User $user, array $values);

    /**
     * @param \App\Todos\Todo $todo
     * @param array $values
     * @return \App\Todos\Todo
     */
    public function update(Todo $todo, array $values);
    
    /**
     * @param \App\Todos\Todo $todo
     */
    public function delete(Todo $todo);
    
    /**
     * @param int $id
     * @return \App\Todos\Todo|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param \App\Users\User $user
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountAndUserPaginated(Account $account, User $user, $limit = 10);
}
