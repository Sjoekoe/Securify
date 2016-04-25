<?php
namespace App\Api\Incidents;

use App\Api\Accounts\AccountTransformer;
use App\Incidents\Incident;
use League\Fractal\TransformerAbstract;

class IncidentTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
    ];
    
    /**
     * @param \App\Incidents\Incident $incident
     * @return array
     */
    public function transform(Incident $incident)
    {
        return [
            'id' => $incident->id(),
            'type' => $incident->type(),
            'created_at' => $incident->createdAt()->toIso8601String(),
            'ended_at' => $incident->endedAt() ? $incident->endedAt()->toIso8601String() : null,
        ];
    }

    /**
     * @param \App\Incidents\Incident $incident
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Incident $incident)
    {
        return $this->item($incident->account(), new AccountTransformer());
    }
}
