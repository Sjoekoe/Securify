<?php
namespace App\Api\Http\Controllers\Accounts\Transports;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Transports\Requests\StoreTransportRequest;
use App\Api\Transports\TransportTransformer;
use App\Transports\Transport;
use App\Transports\TransportCreator;
use App\Transports\TransportRepository;

class TransportController extends Controller
{
    /**
     * @var \App\Transports\TransportRepository
     */
    private $transports;

    public function __construct(TransportRepository $transports)
    {
        $this->transports = $transports;
    }

    public function index(Account $account)
    {
        $transports = $this->transports->findByAccountPaginated($account);

        return $this->response()->paginator($transports, new TransportTransformer());
    }

    public function store(StoreTransportRequest $request, TransportCreator $creator, Account $account)
    {
        $transport = $creator->create($account, $request->all());

        return $this->response()->item($transport, new TransportTransformer());
    }

    public function show(Account $account, Transport $transport)
    {
        return $this->response()->item($transport, new TransportTransformer());
    }
    
    public function update(StoreTransportRequest $request, Account $account, Transport $transport)
    {
        $transport = $this->transports->update($transport, $request->all());
        
        return $this->response()->item($transport, new TransportTransformer());
    }

    public function delete(Account $account, Transport $transport)
    {
        $this->transports->delete($transport);

        return $this->response()->noContent();
    }
}
