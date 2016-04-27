<?php
namespace App\Items;

use App\Accounts\Account;

interface ItemRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Items\Item
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Items\Item $item
     * @param array $values
     * @return \App\Items\Item
     */
    public function update(Item $item, array $values);
    
    /**
     * @param \App\Items\Item $item
     */
    public function delete(Item $item);
    
    /**
     * @param int $id
     * @return \App\Items\Item|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
