<?php
namespace App\Employees;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class EmployeeRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Employees\EmployeeRepository
     */
    private $employees;

    public function __construct(EmployeeRepository $employees)
    {
        $this->employees = $employees;
    }

    /**
     * @param int|string $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->employees->find($id);
    }
}
