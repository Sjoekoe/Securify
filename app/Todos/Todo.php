<?php
namespace App\Todos;

interface Todo
{
    const TABLE = 'todos';
    
    /**
     * @return int
     */
    public function id();

    /**
     * @return string
     */
    public function name();

    /**
     * @return \Carbon\Carbon
     */
    public function date();

    /**
     * @return bool
     */
    public function finished();

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
