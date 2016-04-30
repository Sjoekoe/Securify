<?php
namespace App\Vehicles;

interface Vehicle
{
    const TABLE = 'vehicles';
    const CAR = 'car';
    
    /**
     * @return int
     */
    public function id();

    /**
     * @return string
     */
    public function type();

    /**
     * @return string
     */
    public function licensePLate();

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
