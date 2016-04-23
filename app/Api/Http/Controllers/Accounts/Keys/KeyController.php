<?php
namespace App\Api\Http\Controllers\Accounts\Keys;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Keys\KeyTransformer;
use App\Api\Keys\Requests\StoreKeyRequest;
use App\Keys\Key;
use App\Keys\KeyRepository;

class KeyController extends Controller
{
    /**
     * @var \App\Keys\KeyRepository
     */
    private $keys;

    public function __construct(KeyRepository $keys)
    {
        $this->keys = $keys;
    }

    public function index(Account $account)
    {
        $keys = $this->keys->findByAccountPaginated($account);

        return $this->response()->paginator($keys, new KeyTransformer());
    }

    public function store(StoreKeyRequest $request, Account $account)
    {
        $key = $this->keys->create($account, $request->all());

        return $this->response()->item($key, new KeyTransformer());
    }

    public function show(Account $account, Key $key)
    {
        return $this->response()->item($key, new KeyTransformer());
    }

    public function update(StoreKeyRequest $request, Account $account, Key $key)
    {
        $key = $this->keys->update($key, $request->all());

        return $this->response()->item($key, new KeyTransformer());
    }

    public function delete(Account $account, Key $key)
    {
        $this->keys->delete($key);

        return $this->response()->noContent();
    }
}
