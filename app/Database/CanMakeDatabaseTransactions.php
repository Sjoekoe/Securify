<?php
namespace App\Database;

trait CanMakeDatabaseTransactions
{
    /**
     * @var \App\Database\TransactionManager
     */
    protected $transactionManager;

    /**
     * @param \Closure $callback
     * @return mixed
     */
    public function transaction(\Closure $callback)
    {
        return $this->transactionManager->transaction($callback);
    }
}
