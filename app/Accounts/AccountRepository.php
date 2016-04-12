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
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Accounts\Account
     */
    public function update(Account $account, array $values);

    /**
     * @param \App\Accounts\Account $account
     */
    public function delete(Account $account);

    /**
     * @param int $id
     * @return \App\Accounts\Account
     */
    public function find($id);

    /**
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findAllPaginated($limit = 10);
}
