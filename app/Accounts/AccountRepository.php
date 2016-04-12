<?php
namespace App\Accounts;

interface AccountRepository
{
    /**
     * @param array $values
     * @return \App\Accounts\Account
     */
    public function create(array $values);

    /**
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findAllPaginated($limit = 10);
}
