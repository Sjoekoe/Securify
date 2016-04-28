<?php
namespace App\Api\Http\Controllers\Accounts\Items\Groups;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Items\Groups\ItemGroupTransformer;
use App\Api\Items\Groups\Requests\StoreItemGroupRequest;
use App\Items\Groups\ItemGroup;
use App\Items\Groups\ItemGroupRepository;

class ItemGroupController extends Controller
{
    /**
     * @var \App\Items\Groups\ItemGroupRepository
     */
    private $itemGroups;

    public function __construct(ItemGroupRepository $itemGroups)
    {
        $this->itemGroups = $itemGroups;
    }

    public function index(Account $account)
    {
        $itemGroups = $this->itemGroups->findByAccountPaginated($account);

        return $this->response()->paginator($itemGroups, new ItemGroupTransformer());
    }
    
    public function store(StoreItemGroupRequest $request, Account $account)
    {
        $itemGroup = $this->itemGroups->create($account, $request->all());
        
        return $this->response()->item($itemGroup, new ItemGroupTransformer());
    }

    public function show(Account $account, ItemGroup $itemGroup)
    {
        return $this->response()->item($itemGroup, new ItemGroupTransformer());
    }
    
    public function update(StoreItemGroupRequest $request, Account $account, ItemGroup $itemGroup)
    {
        $itemGroup = $this->itemGroups->update($itemGroup, $request->all());
        
        return $this->response()->item($itemGroup, new ItemGroupTransformer());
    }

    public function delete(Account $account, ItemGroup $itemGroup)
    {
        $this->itemGroups->delete($itemGroup);

        return $this->response()->noContent();
    }
}
