<?php
namespace App\Keys;

use App\Accounts\Account;

class EloquentKeyRepository implements KeyRepository
{
    /**
     * @var \App\Keys\EloquentKey
     */
    private $key;

    public function __construct(EloquentKey $key)
    {
        $this->key = $key;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Keys\Key
     */
    public function create(Account $account, array $values)
    {
        $key = new EloquentKey($values);
        $key->account_id = $account->id();

        $key->save();

        return $key;
    }

    /**
     * @param \App\Keys\Key $key
     * @param array $values
     * @return \App\Keys\Key
     */
    public function update(Key $key, array $values)
    {

        if (array_key_exists('name', $values)) {
            $key->name = $values['name'];
        }

        if (array_key_exists('key_code', $values)) {
            $key->key_code = $values['key_code'];
        }

        if (array_key_exists('number', $values)) {
            $key->number = $values['number'];
        }

        if (array_key_exists('description', $values)) {
            $key->description = $values['description'];
        }

        $key->save();

        return $key;
    }

    /**
     * @param \App\Keys\Key $key
     */
    public function delete(Key $key)
    {
        $key->delete();
    }

    /**
     * @param int $id
     * @return \App\Keys\Key|null
     */
    public function find($id)
    {
        return $this->key->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\Paginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->key
            ->where('account_id', $account->id())
            ->orderBy('number')
            ->paginate($limit);
    }
}
