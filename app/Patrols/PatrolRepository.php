<?php
namespace App\Patrols;

use App\Accounts\Account;

interface PatrolRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Patrols\Patrol
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Patrols\Patrol $patrol
     * @param array $values
     * @return \App\Patrols\Patrol
     */
    public function update(Patrol $patrol, array $values);
    
    /**
     * @param \App\Patrols\Patrol $patrol
     */
    public function delete(Patrol $patrol);
    
    /**
     * @param int $id
     * @return \App\Patrols\Patrol|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
