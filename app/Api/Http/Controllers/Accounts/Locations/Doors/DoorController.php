<?php
namespace App\Api\Http\Controllers\Accounts\Locations\Doors;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Locations\Doors\DoorTransformer;
use App\Api\Locations\Doors\Requests\StoreDoorRequest;
use App\Api\Locations\Doors\Requests\UpdateDoorRequest;
use App\Locations\Doors\Door;
use App\Locations\Doors\DoorCreator;
use App\Locations\Doors\DoorRepository;

class DoorController extends Controller
{
    /**
     * @var \App\Locations\Doors\DoorRepository
     */
    private $doors;

    public function __construct(DoorRepository $doors)
    {
        $this->doors = $doors;
    }

    public function index(Account $account)
    {
        $doors = $this->doors->findByAccountPaginated($account);

        return $this->response()->paginator($doors, new DoorTransformer());
    }

    public function store(DoorCreator $creator, StoreDoorRequest $request, Account $account)
    {
        $door = $creator->create($account, $request->all());

        return $this->response()->item($door, new DoorTransformer());
    }

    public function show(Account $account, Door $door)
    {
        return $this->response()->item($door, new DoorTransformer());
    }

    public function update(UpdateDoorRequest $request, Account $account, Door $door)
    {
        $door = $this->doors->update($door, $request->all());

        return $this->response()->item($door, new DoorTransformer());
    }

    public function delete(Account $account, Door $door)
    {
        $this->doors->delete($door);

        return $this->response()->noContent();
    }
}
