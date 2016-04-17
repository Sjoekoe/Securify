<?php
namespace App\Visitors;

use App\Accounts\Account;

interface VisitorRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Visitors\Visitor
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Visitors\Visitor $visitor
     * @param array $values
     * @return \App\Visitors\Visitor
     */
    public function update(Visitor $visitor, array $values);
    
    /**
     * @param \App\Visitors\Visitor $visitor
     */
    public function delete(Visitor $visitor);
    
    /**
     * @param int $id
     * @return \App\Visitors\Visitor|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
