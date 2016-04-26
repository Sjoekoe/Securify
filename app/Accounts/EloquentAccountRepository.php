<?php
namespace App\Accounts;

class EloquentAccountRepository implements AccountRepository
{
    /**
     * @var \App\Accounts\EloquentAccount
     */
    private $account;

    public function __construct(EloquentAccount $account)
    {
        $this->account = $account;
    }

    /**
     * @param array $values
     * @return \App\Accounts\Account
     */
    public function create(array $values)
    {
        $account = new EloquentAccount($values);
        $account->date_format = 'd-m-y';
        $account->time_format = 'HH:MM';
        $account->save();

        return $account;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Accounts\Account
     */
    public function update(Account $account, array $values)
    {
        $account->update($values);
        $account->save();

        return $account;
    }

    /**
     * @param \App\Accounts\Account $account
     */
    public function delete(Account $account)
    {
        $account->delete();
    }

    /**
     * @param int $id
     * @return \App\Accounts\Account
     */
    public function find($id)
    {
        return $this->account->where('id', $id)->first();
    }

    /**
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findAllPaginated($limit = 10)
    {
        return $this->account->paginate($limit);
    }
}
