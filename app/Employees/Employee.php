<?php
namespace App\Employees;

interface Employee
{
    const TABLE = 'employees';
    
    /**
     * @return int
     */
    public function id();

    /**
     * @return string
     */
    public function name();

    /**
     * @return string
     */
    public function number();

    /**
     * @return string
     */
    public function telephone();

    /**
     * @return string
     */
    public function email();

    /**
     * @return \App\Accounts\Account
     */
    public function account();

    /**
     * @return \Carbon\Carbon
     */
    public function createdAt();

    /**
     * @return \Carbon\Carbon
     */
    public function updatedAt();
}
