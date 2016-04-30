<?php
namespace App\Transports;

interface Transport
{
    const TABLE = 'transports';
    
    /**
     * @return int
     */
    public function id();

    /**
     * @return string
     */
    public function product();

    /**
     * @return string
     */
    public function number();

    /**
     * @return \App\Accounts\Account
     */
    public function account();

    /**
     * @return \App\Vehicles\Vehicle
     */
    public function vehicle();

    /**
     * @return \Carbon\Carbon
     */
    public function createdAt();

    /**
     * @return \Carbon\Carbon
     */
    public function updatedAt();
}
