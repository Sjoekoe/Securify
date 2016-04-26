<?php
namespace App\Api\Patrols;

use App\Api\Accounts\AccountTransformer;
use App\Patrols\Patrol;
use League\Fractal\TransformerAbstract;

class PatrolTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation'
    ];
    
    /**
     * @param \App\Patrols\Patrol $patrol
     * @return array
     */
    public function transform(Patrol $patrol)
    {
        return [
            'id' => $patrol->id(),
            'name' => $patrol->name(),
            'description' => $patrol->description(),
        ];
    }

    /**
     * @param \App\Patrols\Patrol $patrol
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Patrol $patrol)
    {
        return $this->item($patrol->account(), new AccountTransformer());
    }
}
