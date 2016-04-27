<?php
namespace functional\Api\People;

use App\Helpers\DefaultIncludes;
use App\Visits\Visit;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VisitsTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_visits_for_an_account()
    {
        $account = $this->createAccount();
        $visit = $this->createVisit($account);

        $this->get('/api/accounts/' . $account->id() . '/visits', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedVisit($visit),
                ],
                'meta' => [
                    'pagination' => [
                        'count' => 1,
                        'current_page' => 1,
                        'links' => [],
                        'per_page' => 10,
                        'total' => 1,
                        'total_pages' => 1,
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_show_a_visit()
    {
        $account = $this->createAccount();
        $visit = $this->createVisit($account);

        $this->get('/api/accounts/' . $account->id() . '/visits/' . $visit->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedVisit($visit),
            ]);
    }

    /** @test */
    function it_can_delete_a_visit()
    {
        $account = $this->createAccount();
        $visit = $this->createVisit($account);

        $this->seeInDatabase(Visit::TABLE, [
            'id' => $visit->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/visits/' . $visit->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Visit::TABLE, [
            'id' => $visit->id(),
        ]);
    }
}
