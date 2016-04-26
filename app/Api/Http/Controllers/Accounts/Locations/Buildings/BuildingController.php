<?php
namespace App\Api\Http\Controllers\Accounts\Locations\Buildings;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Locations\Buildings\BuildingTransformer;
use App\Api\Locations\Buildings\Requests\StoreBuildingRequest;
use App\Locations\Buildings\Building;
use App\Locations\Buildings\BuildingRepository;

class BuildingController extends Controller
{
    /**
     * @var \App\Locations\Buildings\BuildingRepository
     */
    private $buildings;

    public function __construct(BuildingRepository $buildings)
    {
        $this->buildings = $buildings;
    }

    public function index(Account $account)
    {
        $buildings = $this->buildings->findByAccountPaginated($account);

        return $this->response()->paginator($buildings, new BuildingTransformer());
    }

    public function store(StoreBuildingRequest $request, Account $account)
    {
        $building = $this->buildings->create($account, $request->all());

        return $this->response()->item($building, new BuildingTransformer());
    }

    public function show(Account $account, Building $building)
    {
        return $this->response()->item($building, new BuildingTransformer());
    }

    public function update(StoreBuildingRequest $request, Account $account, Building $building)
    {
        $building = $this->buildings->update($building, $request->all());

        return $this->response()->item($building, new BuildingTransformer());
    }

    public function delete(Account $account, Building $building)
    {
        $this->buildings->delete($building);

        return $this->response()->noContent();
    }
}
