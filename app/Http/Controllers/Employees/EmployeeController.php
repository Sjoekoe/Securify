<?php
namespace App\Http\Controllers\Employees;

use App\Core\Info\Info;
use App\Employees\Employee;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index');
    }
    
    public function create()
    {
        return view('employees.create');
    }
    
    public function edit(Info $info, Employee $employee)
    {
        $info->flash('employee', $employee->id());
        
        return view('employees.edit');
    }
}
