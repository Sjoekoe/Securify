<?php
namespace App\Database;

use Closure;

interface TransactionManager
{
    /**
     * @param \Closure $callback
     * @return mixed
     */
    public function transaction(Closure $callback);
}
