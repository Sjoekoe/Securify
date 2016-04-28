<?php
namespace App\Items\Groups;

use App\Accounts\Account;

class EloquentItemGroupRepository implements ItemGroupRepository
{
    /**
     * @var \App\Items\Groups\EloquentItemGroup
     */
    private $itemGroup;

    public function __construct(EloquentItemGroup $itemGroup)
    {
        $this->itemGroup = $itemGroup;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Items\Groups\ItemGroup
     */
    public function create(Account $account, array $values)
    {
        $itemGroup = new EloquentItemGroup($values);
        $itemGroup->account_id = $account->id();

        $itemGroup->save();

        return $itemGroup;
    }

    /**
     * @param \App\Items\Groups\ItemGroup $itemGroup
     * @param array $values
     * @return \App\Items\Groups\ItemGroup
     */
    public function update(ItemGroup $itemGroup, array $values)
    {
        if (array_key_exists('name', $values)) {
            $itemGroup->name = $values['name'];
        }

        $itemGroup->save();

        return $itemGroup;
    }

    /**
     * @param \App\Items\Groups\ItemGroup $itemGroup
     */
    public function delete(ItemGroup $itemGroup)
    {
        $itemGroup->delete();
    }

    /**
     * @param int $id
     * @return \App\Items\Groups\ItemGroup|null
     */
    public function find($id)
    {
        return $this->itemGroup->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->itemGroup
            ->where('account_id', $account->id())
            ->paginate($limit);
    }
}
