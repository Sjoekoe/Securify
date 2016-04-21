<?php
namespace App\Visits;

use App\Accounts\Account;
use App\Companies\Company;
use App\Employees\Employee;
use App\Visitors\Visitor;

interface VisitRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param \App\Employees\Employee $employee
     * @param \App\Visitors\Visitor $visitor
     * @param array $values
     * @return \App\Visits\Visit
     */
    public function create(Account $account, Employee $employee, Visitor $visitor, array $values);
    
    /**
     * @param \App\Visits\Visit $visit
     * @param array $values
     * @return \App\Visits\Visit
     */
    public function update(Visit $visit, array $values);
    
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
