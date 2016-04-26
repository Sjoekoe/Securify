<?php
namespace App\Patrols;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class PatrolRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Patrols\PatrolRepository
     */
    private $patrols;

    public function __construct(PatrolRepository $patrols)
    {
        $this->patrols = $patrols;
    }

    /**
     * @param int|string $id
     * @return \App\Patrols\Patrol|null
     */
    public function find($id)
    {
        return $this->patrols->find($id);
    }
}
