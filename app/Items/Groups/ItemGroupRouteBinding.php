<?php
namespace App\Items\Groups;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class ItemGroupRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Items\Groups\ItemGroupRepository
     */
    private $itemGroups;

    public function __construct(ItemGroupRepository $itemGroups)
    {
        $this->itemGroups = $itemGroups;
    }

    /**
     * @param int|string $id
     * @return \App\Items\Groups\ItemGroup|null
     */
    public function find($id)
    {
        return $this->itemGroups->find($id);
    }
}
