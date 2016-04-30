<?php
namespace App\Transports;

use App\Accounts\Account;
use App\Vehicles\Vehicle;

interface TransportRepository
{
    /**
     * @param \App\Accounts\Account $account
     * @param \App\Vehicles\Vehicle $vehicle
     * @param array $values
     * @return \App\Transports\Transport
     */
    public function create(Account $account, Vehicle $vehicle, array $values);

    /**
     * @param \App\Transports\Transport $transport
     * @param array $values
     * @return \App\Transports\Transport
     */
    public function update(Transport $transport, array $values);
    
    /**
     * @param \App\Transports\Transport $transport
     */
    public function delete(Transport $transport);
    
    /**
     * @param int $id
     * @return \App\Transports\Transport|null
     */
    public function find($id);
    
    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10);
}
