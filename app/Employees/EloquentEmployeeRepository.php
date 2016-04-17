<?php
namespace App\Employees;

use App\Accounts\Account;

class EloquentEmployeeRepository implements EmployeeRepository
{
    /**
     * @var \App\Employees\EloquentEmployee
     */
    private $employee;

    public function __construct(EloquentEmployee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Employees\Employee
     */
    public function create(Account $account, array $values)
    {
        $employee = new EloquentEmployee();
        $employee->email = $values['email'];
        $employee->number = array_get($values, 'number');
        $employee->name = $values['name'];
        $employee->telephone = array_get($values, 'telephone');
        $employee->account_id = $account->id();

        $employee->save();

        return $employee;
    }

    /**
     * @param \App\Employees\Employee $employee
     * @param array $values
     * @return \App\Employees\Employee
     */
    public function update(Employee $employee, array $values)
    {
        if (array_key_exists('name', $values)) {
            $employee->name = $values['name'];
        }

        if (array_key_exists('email', $values)) {
            $employee->email = $values['email'];
        }

        if (array_key_exists('telephone', $values)) {
            $employee->telephone = $values['telephone'];
        }

        if (array_key_exists('number', $values)) {
            $employee->number = $values['number'];
        }

        $employee->save();

        return $employee;
    }

    /**
     * @param \App\Employees\Employee $employee
     */
    public function delete(Employee $employee)
    {
        $employee->delete();
    }

    /**
     * @param int $id
     * @return \App\Employees\Employee|null
     */
    public function find($id)
    {
        return $this->employee->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->employee
            ->where('account_id', $account->id())
            ->orderBy('name')
            ->paginate($limit);
    }
}
