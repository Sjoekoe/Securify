<?php
namespace App\Teams;

interface Team
{
    const TABLE = 'teams';
    
    /**
     * @return int
     */
    public function id();

    /**
     * @return \App\Users\User
     */
    public function user();

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
