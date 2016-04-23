<?php
namespace App\Api\Keys;

use App\Api\Accounts\AccountTransformer;
use App\Keys\Key;
use League\Fractal\TransformerAbstract;

class KeyTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
    ];

    /**
     * @param \App\Keys\Key $key
     * @return array
     */
    public function transform(Key $key)
    {
        return [
            'id' => $key->id(),
            'name' => $key->name(),
            'key_code' => $key->keyCode(),
            'number' => $key->number(),
            'description' => $key->description(),
        ];
    }

    /**
     * @param \App\Keys\Key $key
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Key $key)
    {
        return $this->item($key->account(), new AccountTransformer());
    }
}
