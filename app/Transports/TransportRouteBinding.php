<?php
namespace App\Transports;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class TransportRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Transports\TransportRepository
     */
    private $transports;

    public function __construct(TransportRepository $transports)
    {
        $this->transports = $transports;
    }

    /**
     * @param int $id
     * @return \App\Transports\Transport|null
     */
    public function find($id)
    {
        return $this->transports->find($id);
    }
}
