<?php
namespace functional\Api\Incidents;

use App\Helpers\DefaultIncludes;
use App\Incidents\Incident;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IncidentTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_show_all_incidents_for_an_account()
    {
        $account = $this->createAccount();
        $incident = $this->createIncident([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/incidents', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedIncident($incident),
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
                ]
            ]);
    }

    /** @test */
    function it_can_create_an_incident()
    {
        $now = Carbon::now();

        $account = $this->createAccount();

        $this->post('/api/accounts/' . $account->id() . '/incidents', [
            'type' => 1
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(Incident::TABLE)->first()->id,
                    'type' => 1,
                    'created_at' => $now->toIso8601String(),
                    'ended_at' => null,
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_not_show_an_incident_that_does_not_belong_to_the_account()
    {
        $account = $this->createAccount();
        $incident = $this->createIncident([
            'account_id' => $account->id(),
        ]);
        $account2 = $this->createAccount();

        $this->get('/api/accounts/' . $account2->id() . '/incidents/' . $incident->id(), $this->setJWTHeaders())
            ->assertForbidden();
    }

    /** @test */
    function it_can_show_an_incident()
    {
        $account = $this->createAccount();
        $incident = $this->createIncident([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/incidents/' . $incident->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedIncident($incident),
            ]);
    }

    /** @test */
    function it_can_update_an_incident()
    {
        $account = $this->createAccount();
        $incident = $this->createIncident([
            'account_id' => $account->id(),
        ]);

        $end = Carbon::now();

        $this->put('/api/accounts/' . $account->id() . '/incidents/' . $incident->id(), [
            'ended_at' => $end->format('d-m-Y - H:i')
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => $this->includedIncident($incident, [
                'ended_at' => $end->second(0)->toIso8601String(),
            ]),
        ]);
    }

    /** @test */
    function it_can_delete_an_incident()
    {
        $account = $this->createAccount();
        $incident = $this->createIncident([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(Incident::TABLE, [
            'id' => $incident->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/incidents/' . $incident->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Incident::TABLE, [
            'id' => $incident->id(),
        ]);
    }
}
