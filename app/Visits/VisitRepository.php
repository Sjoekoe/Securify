<?php
namespace App\Visits;

use App\Accounts\Account;

interface VisitRepository
{
    /**
     * @param \App\Visits\Visit $visit
     */
    public function delete(Visit $visit);
    
    /**
     * @param int $id
     * @return \App\Visits\Visit|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
