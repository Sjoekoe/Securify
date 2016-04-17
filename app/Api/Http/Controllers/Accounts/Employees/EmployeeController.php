<?php
namespace App\Api\Http\Controllers\Accounts\Employees;

use App\Accounts\Account;
use App\Api\Employees\EmployeeTransformer;
use App\Api\Employees\Requests\StoreEmployeeRequest;
use App\Api\Http\Controller;
use App\Employees\Employee;
use App\Employees\EmployeeRepository;

class EmployeeController extends Controller
{
    /**
     * @var \App\Employees\EmployeeRepository
     */
    private $employees;

    public function __construct(EmployeeRepository $employees)
    {
        $this->employees = $employees;
    }

    public function index(Account $account)
    {
        $employees = $this->employees->findByAccountPaginated($account);

        return $this->response()->paginator($employees, new EmployeeTransformer());
    }

    public function store(StoreEmployeeRequest $request, Account $account)
    {
        $employee = $this->employees->create($account, $request->all());

        return $this->response()->item($employee, new EmployeeTransformer());
    }

    public function show(Account $account, Employee $employee)
    {
        return $this->response()->item($employee, new EmployeeTransformer());
    }

    public function update(StoreEmployeeRequest $request, Account $account, Employee $employee)
    {
        $employee = $this->employees->update($employee, $request->all());

        return $this->response()->item($employee, new EmployeeTransformer());
    }

    public function delete(Account $account, Employee $employee)
    {
        $this->employees->delete($employee);

        return $this->response()->noContent();
    }
}
