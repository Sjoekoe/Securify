<?php
namespace App\Keys;

use App\Accounts\Account;

interface KeyRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Keys\Key
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Keys\Key $key
     * @param array $values
     * @return \App\Keys\Key
     */
    public function update(Key $key, array $values);

    /**
     * @param \App\Keys\Key $key
     */
    public function delete(Key $key);

    /**
     * @param int $id
     * @return \App\Keys\Key|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\Paginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
