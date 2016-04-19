<?php
namespace App\Accounts;

interface Account
{
    const TABLE = 'accounts';
    
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
    public function vat();

    /**
     * @return string
     */
    public function website();

    /**
     * @return string
     */
    public function dateFormat();

    /**
     * @return string
     */
    public function timeFormat();

    /**
     * @return \Carbon\Carbon
     */
    public function createdAt();

    /**
     * @return \Carbon\Carbon
     */
    public function updatedAt();
}
