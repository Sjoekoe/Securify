<?php
namespace App\Teams;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class TeamRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Teams\TeamRepository
     */
    private $teams;

    public function __construct(TeamRepository $teams)
    {
        $this->teams = $teams;
    }

    /**
     * @param int|string $id
     * @return \App\Teams\Team|null
     */
    public function find($id)
    {
        return $this->teams->find($id);
    }
}
