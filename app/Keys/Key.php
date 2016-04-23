<?php
namespace App\Keys;

interface Key
{
    const TABLE = 'keys';
    
    /**
     * @return int
     */
    public function id();

    /**
     * @return string
     */
    public function number();

    /**
     * @return string
     */
    public function name();

    /**
     * @return string
     */
    public function keyCode();

    /**
     * @return string
     */
    public function description();

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
