<?php
namespace App\Api\Http\Controllers\Accounts\Incidents;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Incidents\IncidentTransformer;
use App\Api\Incidents\Requests\ShowIncidentRequest;
use App\Api\Incidents\Requests\StoreIncidentRequest;
use App\Incidents\Incident;
use App\Incidents\IncidentRepository;

class IncidentController extends Controller
{
    /**
     * @var \App\Incidents\IncidentRepository
     */
    private $incidents;

    public function __construct(IncidentRepository $incidents)
    {
        $this->incidents = $incidents;
    }

    public function index(Account $account)
    {
        $incidents = $this->incidents->findByAccountPaginated($account);

        return $this->response()->paginator($incidents, new IncidentTransformer());
    }

    public function store(StoreIncidentRequest $request, Account $account)
    {
        $incident = $this->incidents->create($account, $request->all());

        return $this->response()->item($incident, new IncidentTransformer());
    }

    public function show(ShowIncidentRequest $request, Account $account, Incident $incident)
    {
        return $this->response()->item($incident, new IncidentTransformer());
    }

    public function update(ShowIncidentRequest $request, Account $account, Incident $incident)
    {
        $incident = $this->incidents->update($incident, $request->all());

        return $this->response()->item($incident, new IncidentTransformer());
    }

    public function delete(ShowIncidentRequest $request, Account $account, Incident $incident)
    {
        $this->incidents->delete($incident);

        return $this->response()->noContent();
    }
}
