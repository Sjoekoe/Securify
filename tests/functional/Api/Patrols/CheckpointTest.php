<?php
namespace functional\Api\Patrols;

use App\Helpers\DefaultIncludes;
use App\Patrols\Checkpoints\Checkpoint;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckpointTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_checkpoints_for_a_patrol()
    {
        $account = $this->createAccount();
        $patrol = $this->createPatrol([
            'account_id' => $account->id(),
        ]);
        $building = $this->createBuilding([
            'account_id' => $account->id(),
        ]);
        $key = $this->createKey([
            'account_id' => $account->id(),
        ]);
        $door = $this->createDoor([
            'account_id' => $account->id(),
            'building_id' => $building->id(),
            'key_id' => $key->id(),
        ]);
        $checkpoint = $this->createCheckpoint([
            'account_id' => $account->id(),
            'patrol_id' => $patrol->id(),
            'door_id' => $door->id()
        ]);

        $this->get('/api/accounts/' . $account->id() . '/patrols/' . $patrol->id() . '/checkpoints', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedCheckpoint($checkpoint),
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
    function it_can_create_a_checkpoint()
    {
        $account = $this->createAccount();
        $patrol = $this->createPatrol([
            'account_id' => $account->id(),
        ]);
        $building = $this->createBuilding([
            'account_id' => $account->id(),
        ]);
        $key = $this->createKey([
            'account_id' => $account->id(),
        ]);
        $door = $this->createDoor([
            'account_id' => $account->id(),
            'building_id' => $building->id(),
            'key_id' => $key->id(),
        ]);

        $this->post('/api/accounts/' . $account->id() . '/patrols/' . $patrol->id() . '/checkpoints', [
            'name' => 'Patrol 1',
            'description' => 'Some description',
            'door_id' => $door->id(),
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(Checkpoint::TABLE)->first()->id,
                    'name' => 'Patrol 1',
                    'description' => 'Some description',
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                    'patrolRelation' => [
                        'data' => $this->includedPatrol($patrol),
                    ],
                    'doorRelation' => [
                        'data' => $this->includedDoor($door),
                    ],
                ]
            ]);
    }

    /** @test */
    function it_can_show_a_checkpoint()
    {
        $account = $this->createAccount();
        $patrol = $this->createPatrol([
            'account_id' => $account->id(),
        ]);
        $building = $this->createBuilding([
            'account_id' => $account->id(),
        ]);
        $key = $this->createKey([
            'account_id' => $account->id(),
        ]);
        $door = $this->createDoor([
            'account_id' => $account->id(),
            'building_id' => $building->id(),
            'key_id' => $key->id(),
        ]);
        $checkpoint = $this->createCheckpoint([
            'account_id' => $account->id(),
            'patrol_id' => $patrol->id(),
            'door_id' => $door->id()
        ]);

        $this->get('/api/accounts/' . $account->id() . '/patrols/' . $patrol->id() . '/checkpoints/' . $checkpoint->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedCheckpoint($checkpoint),
            ]);
    }

    /** @test */
    function it_can_update_a_checkpoint()
    {
        $account = $this->createAccount();
        $patrol = $this->createPatrol([
            'account_id' => $account->id(),
        ]);
        $building = $this->createBuilding([
            'account_id' => $account->id(),
        ]);
        $key = $this->createKey([
            'account_id' => $account->id(),
        ]);
        $door = $this->createDoor([
            'account_id' => $account->id(),
            'building_id' => $building->id(),
            'key_id' => $key->id(),
        ]);
        $checkpoint = $this->createCheckpoint([
            'account_id' => $account->id(),
            'patrol_id' => $patrol->id(),
            'door_id' => $door->id()
        ]);

        $this->put('/api/accounts/' . $account->id() . '/patrols/' . $patrol->id() . '/checkpoints/' . $checkpoint->id(), [
            'name' =>'Updated name',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedCheckpoint($checkpoint, [
                    'name' => 'Updated name',
                ])
            ]);
    }

    /** @test */
    function it_can_delete_a_checkpoint()
    {
        $account = $this->createAccount();
        $patrol = $this->createPatrol([
            'account_id' => $account->id(),
        ]);
        $building = $this->createBuilding([
            'account_id' => $account->id(),
        ]);
        $key = $this->createKey([
            'account_id' => $account->id(),
        ]);
        $door = $this->createDoor([
            'account_id' => $account->id(),
            'building_id' => $building->id(),
            'key_id' => $key->id(),
        ]);
        $checkpoint = $this->createCheckpoint([
            'account_id' => $account->id(),
            'patrol_id' => $patrol->id(),
            'door_id' => $door->id()
        ]);

        $this->seeInDatabase(Checkpoint::TABLE, [
            'id' => $checkpoint->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/patrols/' . $patrol->id() . '/checkpoints/' . $checkpoint->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Checkpoint::TABLE, [
            'id' => $checkpoint->id(),
        ]);
    }
}
