<?php
namespace App\Incidents;

interface Incident
{
    const TABLE = 'incidents';
    
    /**
     * @return int
     */
    public function id();

    /**
     * @return int
     */
    public function type();

    /**
     * @return \Carbon\Carbon
     */
    public function createdAt();

    /**
     * @return \Carbon\Carbon
     */
    public function updatedAt();

    /**
     * @return \Carbon\Carbon
     */
    public function endedAt();

    /**
     * @return \App\Accounts\Account
     */
    public function account();
}
