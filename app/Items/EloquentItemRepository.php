<?php
namespace App\Items;

use App\Accounts\Account;

class EloquentItemRepository implements ItemRepository
{
    /**
     * @var \App\Items\EloquentItem
     */
    private $item;

    public function __construct(EloquentItem $item)
    {
        $this->item = $item;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Items\Item
     */
    public function create(Account $account, array $values)
    {
        $item = new EloquentItem($values);
        $item->account_id = $account->id();

        $item->save();

        return $item;
    }

    /**
     * @param \App\Items\Item $item
     * @param array $values
     * @return \App\Items\Item
     */
    public function update(Item $item, array $values)
    {
        if (array_key_exists('name', $values)) {
            $item->name = $values['name'];
        }

        if (array_key_exists('description', $values)) {
            $item->description = $values['description'];
        }

        if (array_key_exists('code', $values)) {
            $item->code = $values['code'];
        }

        $item->save();

        return $item;
    }

    /**
     * @param \App\Items\Item $item
     */
    public function delete(Item $item)
    {
        $item->delete();
    }

    /**
     * @param int $id
     * @return \App\Items\Item|null
     */
    public function find($id)
    {
        return $this->item->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->item
            ->where('account_id', $account->id())
            ->paginate($limit);
    }
}
