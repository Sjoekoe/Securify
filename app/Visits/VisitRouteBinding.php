<?php
namespace App\Visits;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class VisitRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Visits\VisitRepository
     */
    private $visits;

    public function __construct(VisitRepository $visits)
    {
        $this->visits = $visits;
    }

    /**
     * @param int|string $id
     * @return \App\Visits\Visit|null
     */
    public function find($id)
    {
        return $this->visits->find($id);
    }
}
