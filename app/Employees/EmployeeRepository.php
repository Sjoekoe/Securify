<?php
namespace App\Employees;

use App\Accounts\Account;

interface EmployeeRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Employees\Employee
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Employees\Employee $employee
     * @param array $values
     * @return \App\Employees\Employee
     */
    public function update(Employee $employee, array $values);

    /**
     * @param \App\Employees\Employee $employee
     */
    public function delete(Employee $employee);

    /**
     * @param int $id
     * @return \App\Employees\Employee|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
