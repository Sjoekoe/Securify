<?php
namespace App\Accounts;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class AccountRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Accounts\AccountRepository
     */
    private $accounts;

    public function __construct(AccountRepository $accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @param int|string $id
     * @return \App\Accounts\Account|null
     */
    public function find($id)
    {
        return $this->accounts->find($id);
    }
}
