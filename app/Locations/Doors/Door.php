<?php
namespace App\Locations\Doors;

interface Door
{
    const TABLE = 'doors';
    
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
     * @return \App\Locations\Buildings\Building
     */
    public function building();

    /**
     * @return \App\Keys\Key
     */
    public function key();

    /**
     * @return \Carbon\Carbon
     */
    public function createdAt();

    /**
     * @return \Carbon\Carbon
     */
    public function updatedAt();
}
