<?php
namespace App\Api\Visits;

use App\Api\Accounts\AccountTransformer;
use App\Api\Employees\EmployeeTransformer;
use App\Api\Visitors\VisitorTransformer;
use App\Visits\Visit;
use League\Fractal\TransformerAbstract;

class VisitTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'accountRelation',
        'employeeRelation',
        'visitorRelation',
    ];

    /**
     * @param \App\Visits\Visit $visit
     * @return array
     */
    public function transform(Visit $visit)
    {
        return [
            'id' => $visit->id(),
            'expected_arrival' => $visit->expectedArrival()->toIso8601String(),
            'expected_departure' => $visit->expectedDeparture()->toIso8601String(),
            'arrival' => $visit->arrival() ? $visit->arrival()->toIso8601String() : null,
            'departure' => $visit->departure() ? $visit->departure()->toIso8601String() : null,
            'is_completed' => $visit->isCompleted(),
        ];
    }

    /**
     * @param \App\Visits\Visit $visit
     * @return \League\Fractal\Resource\Item
     */
    public function includeAccountRelation(Visit $visit)
    {
        return $this->item($visit->account(), new AccountTransformer());
    }

    /**
     * @param \App\Visits\Visit $visit
     * @return \League\Fractal\Resource\Item
     */
    public function includeEmployeeRelation(Visit $visit)
    {
        return $this->item($visit->employee(), new EmployeeTransformer());
    }

    /**
     * @param \App\Visits\Visit $visit
     * @return \League\Fractal\Resource\Item
     */
    public function includeVisitorRelation(Visit $visit)
    {
        return $this->item($visit->visitor(), new VisitorTransformer());
    }
}
