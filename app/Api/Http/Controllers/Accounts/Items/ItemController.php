<?php
namespace App\Api\Http\Controllers\Accounts\Items;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Items\ItemTransformer;
use App\Api\Items\Requests\StoreItemRequest;
use App\Api\Items\Requests\UpdateItemRequest;
use App\Items\Item;
use App\Items\ItemRepository;

class ItemController extends Controller
{
    /**
     * @var \App\Items\ItemRepository
     */
    private $items;

    public function __construct(ItemRepository $items)
    {
        $this->items = $items;
    }

    public function index(Account $account)
    {
        $items = $this->items->findByAccountPaginated($account);

        return $this->response()->paginator($items, new ItemTransformer());
    }
    
    public function store(StoreItemRequest $request, Account $account)
    {
        $item = $this->items->create($account, $request->all());
        
        return $this->response()->item($item, new ItemTransformer());
    }

    public function show(Account $account, Item $item)
    {
        return $this->response()->item($item, new ItemTransformer());
    }
    
    public function update(UpdateItemRequest $request, Account $account, Item $item)
    {
        $item = $this->items->update($item, $request->all());
        
        return $this->response()->item($item, new ItemTransformer());
    }

    public function delete(Account $account, Item $item)
    {
        $this->items->delete($item);

        return $this->response()->noContent();
    }
}
