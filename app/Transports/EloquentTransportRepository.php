<?php
namespace App\Transports;

use App\Accounts\Account;
use App\Vehicles\Vehicle;

class EloquentTransportRepository implements TransportRepository
{
    /**
     * @var \App\Transports\EloquentTransport
     */
    private $transport;

    public function __construct(EloquentTransport $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param \App\Vehicles\Vehicle $vehicle
     * @param array $values
     * @return \App\Transports\Transport
     */
    public function create(Account $account, Vehicle $vehicle, array $values)
    {
        $transport = new EloquentTransport($values);
        $transport->account_id = $account->id();
        $transport->vehicle_id = $vehicle->id();

        $transport->save();

        return $transport;
    }

    /**
     * @param \App\Transports\Transport $transport
     * @param array $values
     * @return \App\Transports\Transport
     */
    public function update(Transport $transport, array $values)
    {
        if (array_key_exists('product', $values)) {
            $transport->product = $values['product'];
        }

        if (array_key_exists('number', $values)) {
            $transport->number = $values['number'];
        }

        $transport->save();

        return $transport;
    }

    /**
     * @param \App\Transports\Transport $transport
     */
    public function delete(Transport $transport)
    {
        $transport->delete();
    }

    /**
     * @param int $id
     * @return \App\Transports\Transport|null
     */
    public function find($id)
    {
        return $this->transport->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->transport
            ->where('account_id', $account->id())
            ->paginate($limit);
    }
}
