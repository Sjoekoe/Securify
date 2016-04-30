<?php
namespace functional\Api\Vehicles;

use App\Helpers\DefaultIncludes;
use App\Vehicles\Vehicle;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VehicleTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_show_all_vehicles_for_an_account()
    {
        $account = $this->createAccount();
        $vehicle = $this->createVehicle([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/vehicles', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedVehicle($vehicle),
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
    function it_can_create_a_vehicle()
    {
        $account = $this->createAccount();

        $this->post('/api/accounts/' . $account->id() . '/vehicles', [
            'type' => Vehicle::CAR,
            'license_plate' => 'Test-123',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(Vehicle::TABLE)->first()->id,
                    'type' => Vehicle::CAR,
                    'license_plate' => 'Test-123',
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_show_a_vehicle()
    {
        $account = $this->createAccount();
        $vehicle = $this->createVehicle([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/vehicles/' . $vehicle->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedVehicle($vehicle),
            ]);
    }

    /** @test */
    function it_can_update_a_vehicle()
    {
        $account = $this->createAccount();
        $vehicle = $this->createVehicle([
            'account_id' => $account->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/vehicles/' . $vehicle->id(), [
            'license_plate' => 'Updated Name',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedVehicle($vehicle, [
                    'license_plate' => 'Updated Name',
                ]),
            ]);
    }

    /** @test */
    function it_can_delete_a_vehicle()
    {
        $account = $this->createAccount();
        $vehicle = $this->createVehicle([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(Vehicle::TABLE, [
            'id' => $vehicle->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/vehicles/' . $vehicle->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Vehicle::TABLE, [
            'id' => $vehicle->id(),
        ]);
    }
}
