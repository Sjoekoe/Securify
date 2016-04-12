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
        $account->save();
        
        return $account;
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
