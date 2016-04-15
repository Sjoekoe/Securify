<?php
namespace App\Api\Employees;

use App\Api\Accounts\AccountTransformer;
use App\Employees\Employee;
use League\Fractal\TransformerAbstract;

class EmployeeTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
    ];
    
    /**
     * @param \App\Employees\Employee $employee
     * @return array
     */
    public function transform(Employee $employee)
    {
        return [
            'id' => $employee->id(),
            'name' => $employee->name(),
            'email' => $employee->email(),
            'number' => $employee->number(),
            'telephone' => $employee->telephone(),
        ];
    }

    /**
     * @param \App\Employees\Employee $employee
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Employee $employee)
    {
        return $this->item($employee->account(), new AccountTransformer());
    }
}
