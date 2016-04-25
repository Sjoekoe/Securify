<?php
namespace App\Incidents;

use App\Accounts\Account;
use Carbon\Carbon;

class EloquentIncidentRepository implements IncidentRepository
{
    /**
     * @var \App\Incidents\EloquentIncident
     */
    private $incident;

    public function __construct(EloquentIncident $incident)
    {
        $this->incident = $incident;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Incidents\Incident
     */
    public function create(Account $account, array $values)
    {
        $incident = new EloquentIncident();
        $incident->ended_at = null;
        $incident->type = $values['type'];
        $incident->account_id = $account->id();

        $incident->save();

        return $incident;
    }

    /**
     * @param \App\Incidents\Incident $incident
     * @param array $values
     * @return \App\Incidents\Incident
     */
    public function update(Incident $incident, array $values)
    {
        if (array_key_exists('ended_at', $values)) {
            $incident->ended_at = Carbon::createFromFormat('d-m-Y - H:i', $values['ended_at']);
        }

        $incident->save();

        return $incident;
    }

    /**
     * @param \App\Incidents\Incident $incident
     */
    public function delete(Incident $incident)
    {
        $incident->delete();
    }

    /**
     * @param int $id
     * @return \App\Incidents\Incident|null
     */
    public function find($id)
    {
        return $this->incident->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->incident
            ->where('account_id', $account->id())
            ->paginate($limit);
    }
}
