<?php
namespace App\Companies;

interface Company
{
    const TABLE = 'companies';
    
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
    public function telephone();

    /**
     * @return string
     */
    public function email();

    /**
     * @return string
     */
    public function website();

    /**
     * @return string
     */
    public function vat();

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
