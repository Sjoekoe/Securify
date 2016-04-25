<?php
namespace App\Incidents;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class IncidentRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Incidents\IncidentRepository
     */
    private $incidents;

    public function __construct(IncidentRepository $incidents)
    {
        $this->incidents = $incidents;
    }

    /**
     * @param int $id
     * @return \App\Incidents\Incident|null
     */
    public function find($id)
    {
        return $this->incidents->find($id);
    }
}
