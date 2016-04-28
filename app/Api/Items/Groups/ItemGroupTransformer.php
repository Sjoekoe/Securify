<?php
namespace App\Api\Items\Groups;

use App\Api\Accounts\AccountTransformer;
use App\Items\Groups\ItemGroup;
use League\Fractal\TransformerAbstract;

class ItemGroupTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
    ];

    /**
     * @param \App\Items\Groups\ItemGroup $itemGroup
     * @return array
     */
    public function transform(ItemGroup $itemGroup)
    {
        return [
            'id' => $itemGroup->id(),
            'name' => $itemGroup->name(),
        ];
    }

    /**
     * @param \App\Items\Groups\ItemGroup $itemGroup
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(ItemGroup $itemGroup)
    {
        return $this->item($itemGroup->account(), new AccountTransformer());
    }
}
