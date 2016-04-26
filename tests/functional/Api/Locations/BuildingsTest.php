<?php
namespace functional\Api\Locations;

use App\Helpers\DefaultIncludes;
use App\Locations\Buildings\Building;

class BuildingsTest extends \TestCase
{
    use DefaultIncludes;

    /** @test */
    function it_can_get_all_buildings_for_an_account()
    {
        $account = $this->createAccount();
        $building = $this->createBuilding([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/buildings', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedBuilding($building),
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
    function it_can_create_a_building()
    {
        $account = $this->createAccount();

        $this->post('/api/accounts/' . $account->id() . '/buildings', [
            'name' => 'Test Building',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => 1,
                    'name' => 'Test Building',
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_show_a_building()
    {
        $account = $this->createAccount();
        $building = $this->createBuilding([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/buildings/' . $building->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedBuilding($building),
            ]);
    }

    /** @test */
    function it_can_update_a_building()
    {
        $account = $this->createAccount();
        $building = $this->createBuilding([
            'account_id' => $account->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/buildings/' . $building->id(), [
            'name' => 'Updated Building',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedBuilding($building, [
                    'name' => 'Updated Building',
                ])
            ]);
    }

    /** @test */
    function it_can_delete_a_building()
    {
        $account = $this->createAccount();
        $building = $this->createBuilding([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(Building::TABLE, [
            'id' => $building->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/buildings/' . $building->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Building::TABLE, [
            'id' => $building->id(),
        ]);
    }
}
