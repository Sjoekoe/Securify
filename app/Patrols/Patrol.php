<?php
namespace App\Patrols;

interface Patrol
{
    const TABLE = 'patrols';
    
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
