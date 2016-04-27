<?php
namespace functional\Api\Locations;

use App\Helpers\DefaultIncludes;
use App\Locations\Doors\Door;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DoorsTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_doors_for_an_account()
    {
        $account = $this->createAccount();
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

        $this->get('/api/accounts/' . $account->id() . '/doors', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedDoor($door),
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
    function it_can_create_a_door()
    {
        $account = $this->createAccount();
        $building = $this->createBuilding([
            'account_id' => $account->id(),
        ]);
        $key = $this->createKey([
            'account_id' => $account->id(),
        ]);

        $this->post('/api/accounts/' . $account->id() . '/doors', [
            'name' => 'Foo Door',
            'description' => 'test description',
            'building_id' => $building->id(),
            'key_id' => $key->id(),
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => [
                'id' => DB::table(Door::TABLE)->first()->id,
                'name' => 'Foo Door',
                'description' => 'test description',
                'keyRelation' => [
                    'data' => $this->includedKey($key),
                ],
                'buildingRelation' => [
                    'data' => $this->includedBuilding($building),
                ],
                'accountRelation' => [
                    'data' => $this->includedAccount($account),
                ],
            ],
        ]);
    }

    /** @test */
    function it_can_show_a_door()
    {
        $account = $this->createAccount();
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

        $this->get('/api/accounts/' . $account->id() . '/doors/' . $door->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedDoor($door),
            ]);
    }

    /** @test */
    function it_can_update_a_door()
    {
        $account = $this->createAccount();
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

        $this->put('/api/accounts/' . $account->id() . '/doors/' . $door->id(), [
            'name' => 'Updated Name',
            'description' => 'updated description',
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => $this->includedDoor($door, [
                'name' => 'Updated Name',
                'description' => 'updated description',
            ]),
        ]);
    }

    /** @test */
    function it_can_delete_a_door()
    {
        $account = $this->createAccount();
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

        $this->seeInDatabase(Door::TABLE, [
            'id' => $door->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/doors/' . $door->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Door::TABLE, [
            'id' => $door->id(),
        ]);
    }
}
