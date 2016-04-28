<?php
namespace App\Items\Groups;

use App\Accounts\Account;

interface ItemGroupRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Items\Groups\ItemGroup
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Items\Groups\ItemGroup $itemGroup
     * @param array $values
     * @return \App\Items\Groups\ItemGroup
     */
    public function update(ItemGroup $itemGroup, array $values);
    
    /**
     * @param \App\Items\Groups\ItemGroup $itemGroup
     */
    public function delete(ItemGroup $itemGroup);
    
    /**
     * @param int $id
     * @return \App\Items\Groups\ItemGroup|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
