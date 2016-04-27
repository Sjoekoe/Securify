<?php
namespace App\Api\Items;

use App\Api\Accounts\AccountTransformer;
use App\Items\Item;
use League\Fractal\TransformerAbstract;

class ItemTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
    ];

    /**
     * @param \App\Items\Item $item
     * @return array
     */
    public function transform(Item $item)
    {
        return [
            'id' => $item->id(),
            'name' => $item->name(),
            'description' => $item->description(),
            'code' => $item->code(),
        ];
    }

    /**
     * @param \App\Items\Item $item
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Item $item)
    {
        return $this->item($item->account(), new AccountTransformer());
    }
}
