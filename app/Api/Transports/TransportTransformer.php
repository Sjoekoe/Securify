<?php
namespace App\Api\Transports;

use App\Api\Accounts\AccountTransformer;
use App\Api\Vehicles\VehicleTransformer;
use App\Transports\Transport;
use League\Fractal\TransformerAbstract;

class TransportTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
        'vehicleRelation',
    ];

    /**
     * @param \App\Transports\Transport $transport
     * @return array
     */
    public function transform(Transport $transport)
    {
        return [
            'id' => $transport->id(),
            'product' => $transport->product(),
            'number' => $transport->number(),
        ];
    }

    /**
     * @param \App\Transports\Transport $transport
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Transport $transport)
    {
        return $this->item($transport->account(), new AccountTransformer());
    }

    /**
     * @param \App\Transports\Transport $transport
     * @return \League\Fractal\Resource\Item
     */
    public function includeVehicleRelation(Transport $transport)
    {
        return $this->item($transport->vehicle(), new VehicleTransformer());
    }
}
