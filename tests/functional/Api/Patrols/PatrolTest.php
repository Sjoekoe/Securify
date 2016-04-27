<?php
namespace functional\Api\Patrols;

use App\Helpers\DefaultIncludes;
use App\Patrols\Patrol;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PatrolTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_patrols_for_an_account()
    {
        $account = $this->createAccount();
        $patrol = $this->createPatrol([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/patrols', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedPatrol($patrol),
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
    function it_can_create_a_patrol()
    {
        $account = $this->createAccount();

        $this->post('/api/accounts/' . $account->id() . '/patrols', [
            'name' => 'Test Patrol',
            'description' => 'Foo description',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(Patrol::TABLE)->first()->id,
                    'name' => 'Test Patrol',
                    'description' => 'Foo description',
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_show_a_patrol()
    {
        $account = $this->createAccount();
        $patrol = $this->createPatrol([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/patrols/' . $patrol->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedPatrol($patrol),
            ]);
    }

    /** @test */
    function it_can_update_a_patrol()
    {
        $account = $this->createAccount();
        $patrol = $this->createPatrol([
            'account_id' => $account->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/patrols/' . $patrol->id(), [
            'name' => 'Updated name',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedPatrol($patrol, [
                    'name' => 'Updated name',
                ]),
            ]);
    }

    /** @test */
    function it_can_delete_a_patrol()
    {
        $account = $this->createAccount();
        $patrol = $this->createPatrol([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(Patrol::TABLE, [
            'id' => $patrol->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/patrols/' . $patrol->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Patrol::TABLE, [
            'id' => $patrol->id(),
        ]);
    }
}
