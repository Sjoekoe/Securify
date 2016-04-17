<?php
namespace App\Api\Teams;

use App\Api\Accounts\AccountTransformer;
use App\Api\Users\UserTransformer;
use App\Teams\Team;
use League\Fractal\TransformerAbstract;

class TeamTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'userRelation',
        'accountRelation',
    ];

    /**
     * @param \App\Teams\Team $team
     * @return array
     */
    public function transform(Team $team)
    {
        return [
            'id' => $team->id(),
        ];
    }

    /**
     * @param \App\Teams\Team $team
     * @return \League\Fractal\Resource\Item
     */
    public function includeUserRelation(Team $team)
    {
        return $this->item($team->user(), new UserTransformer());
    }

    /**
     * @param \App\Teams\Team $team
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Team $team)
    {
        return $this->item($team->account(), new AccountTransformer());
    }
}
