<?php
namespace App\Patrols\Checkpoints;

interface Checkpoint
{
    const TABLE = 'checkpoint';
    
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
     * @return \App\Patrols\Patrol
     */
    public function patrol();

    /**
     * @return \App\Locations\Doors\Door
     */
    public function door();

    /**
     * @return \Carbon\Carbon
     */
    public function createdAt();

    /**
     * @return \Carbon\Carbon
     */
    public function updatedAt();
}
