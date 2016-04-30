<?php
namespace App\Api\Http\Controllers\Accounts\Vehicles;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Vehicles\Requests\StoreVehicleRequest;
use App\Api\Vehicles\Requests\UpdateVehicleRequest;
use App\Api\Vehicles\VehicleTransformer;
use App\Vehicles\Vehicle;
use App\Vehicles\VehicleRepository;

class VehicleController extends Controller
{
    /**
     * @var \App\Vehicles\VehicleRepository
     */
    private $vehicles;

    public function __construct(VehicleRepository $vehicles)
    {
        $this->vehicles = $vehicles;
    }

    public function index(Account $account)
    {
        $vehicles = $this->vehicles->findByAccountPaginated($account);

        return $this->response()->paginator($vehicles, new VehicleTransformer());
    }
    
    public function store(StoreVehicleRequest $request, Account $account)
    {
        $vehicle = $this->vehicles->create($account, $request->all());
        
        return $this->response()->item($vehicle, new VehicleTransformer());
    }

    public function show(Account $account, Vehicle $vehicle)
    {
        return $this->response()->item($vehicle, new VehicleTransformer());
    }
    
    public function update(UpdateVehicleRequest $request, Account $account, Vehicle $vehicle)
    {
        $vehicle = $this->vehicles->update($vehicle, $request->all());
        
        return $this->response()->item($vehicle, new VehicleTransformer());
    }
    
    public function delete(Account $account, Vehicle $vehicle)
    {
        $this->vehicles->delete($vehicle);
        
        return $this->response()->noContent();
    }
}
