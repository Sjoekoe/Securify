<?php
namespace App\Tasks;

interface Task
{
    const TABLE = 'tasks';
    
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
     * @return \Carbon\Carbon
     */
    public function expectedStart();

    /**
     * @return \Carbon\Carbon
     */
    public function expectedEnd();

    /**
     * @return \Carbon\Carbon
     */
    public function finished();

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
