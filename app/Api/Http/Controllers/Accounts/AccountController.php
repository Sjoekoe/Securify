<?php
namespace App\Api\Http\Controllers\Accounts;

use App\Accounts\AccountRepository;
use App\Api\Accounts\AccountTransformer;
use App\Api\Accounts\Requests\StoreAccountRequest;
use App\Api\Http\Controller;

class AccountController extends Controller
{
    /**
     * @var \App\Accounts\AccountRepository
     */
    private $accounts;

    public function __construct(AccountRepository $accounts)
    {
        $this->accounts = $accounts;
    }

    public function index()
    {
        $accounts = $this->accounts->findAllPaginated();

        return $this->response()->paginator($accounts, new AccountTransformer());
    }

    public function store(StoreAccountRequest $request)
    {
        $account = $this->accounts->create($request->all());

        return $this->response()->item($account, new AccountTransformer());
    }
}
