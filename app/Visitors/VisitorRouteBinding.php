<?php
namespace App\Visitors;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class VisitorRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Visitors\VisitorRepository
     */
    private $visitors;

    public function __construct(VisitorRepository $visitors)
    {
        $this->visitors = $visitors;
    }

    /**
     * @param int|string $id
     * @return \App\Visitors\Visitor|null
     */
    public function find($id)
    {
        return $this->visitors->find($id);
    }
}
