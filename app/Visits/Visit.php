<?php
namespace App\Visits;

interface Visit
{
    const TABLE = 'visits';
    
    /**
     * @return int
     */
    public function id();

    /**
     * @return \Carbon\Carbon
     */
    public function expectedArrival();

    /**
     * @return \Carbon\Carbon
     */
    public function expectedDeparture();

    /**
     * @return \Carbon\Carbon
     */
    public function arrival();

    /**
     * @return \Carbon\Carbon
     */
    public function departure();

    /**
     * @return \App\Accounts\Account
     */
    public function account();

    /**
     * @return \App\Visitors\Visitor
     */
    public function visitor();

    /**
     * @return \App\Employees\Employee
     */
    public function employee();

    /**
     * @return bool
     */
    public function isCompleted();

    /**
     * @return \Carbon\Carbon
     */
    public function createdAt();

    /**
     * @return \Carbon\Carbon
     */
    public function updatedAt();
}
