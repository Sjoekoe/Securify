<?php
namespace App\Incidents;

use App\Accounts\Account;

interface IncidentRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Incidents\Incident
     */
    public function create(Account $account, array $values);

    /**
     * @param \App\Incidents\Incident $incident
     * @param array $values
     * @return \App\Incidents\Incident
     */
    public function update(Incident $incident, array $values);
    
    /**
     * @param \App\Incidents\Incident $incident
     */
    public function delete(Incident $incident);
    
    /**
     * @param int $id
     * @return \App\Incidents\Incident|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
