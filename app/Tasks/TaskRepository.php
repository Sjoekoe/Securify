<?php
namespace App\Tasks;

use App\Accounts\Account;

interface TaskRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Tasks\Task
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Tasks\Task $task
     * @param array $values
     * @return \App\Tasks\Task
     */
    public function update(Task $task, array $values);
    
    /**
     * @param \App\Tasks\Task $task
     */
    public function delete(Task $task);
    
    /**
     * @param int $id
     * @return \App\Tasks\Task|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
