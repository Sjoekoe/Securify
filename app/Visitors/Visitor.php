<?php
namespace App\Visitors;

interface Visitor
{
    const TABLE = 'visitors';
    
    /**
     * @return int
     */
    public function id();

    /**
     * @return string
     */
    public function name();

    /**
     * @return \App\Accounts\Account
     */
    public function account();

    /**
     * @return \App\Employees\Employee
     */
    public function employee();

    /**
     * @return \Carbon\Carbon
     */
    public function createdAt();

    /**
     * @return \Carbon\Carbon
     */
    public function updatedAt();
}
