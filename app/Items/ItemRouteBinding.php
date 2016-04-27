<?php
namespace App\Items;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class ItemRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Items\ItemRepository
     */
    private $items;

    public function __construct(ItemRepository $items)
    {
        $this->items = $items;
    }

    /**
     * @param int $id
     * @return \App\Items\Item|null
     */
    public function find($id)
    {
        return $this->items->find($id);
    }
}
