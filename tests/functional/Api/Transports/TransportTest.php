<?php
namespace functional\Api\Transports;

use App\Helpers\DefaultIncludes;
use App\Transports\Transport;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TransportTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_transports_for_an_account()
    {
        $account = $this->createAccount();
        $vehicle = $this->createVehicle([
            'account_id' => $account->id(),
        ]);
        $transport = $this->createTransport([
            'account_id' => $account->id(),
            'vehicle_id' => $vehicle->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/transports', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedTransport($transport),
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
    function it_can_create_a_transport()
    {
        $account = $this->createAccount();
        $vehicle = $this->createVehicle([
            'account_id' => $account->id(),
        ]);

        $this->post('/api/accounts/' . $account->id() . '/transports', [
            'product' => 'test product',
            'number' => '1234FRT',
            'vehicle_id' => $vehicle->id(),
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(Transport::TABLE)->first()->id,
                    'number' => '1234FRT',
                    'product' => 'test product',
                    'vehicleRelation' => [
                        'data' => $this->includedVehicle($vehicle),
                    ],
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_show_a_transport()
    {
        $account = $this->createAccount();
        $vehicle = $this->createVehicle([
            'account_id' => $account->id(),
        ]);
        $transport = $this->createTransport([
            'account_id' => $account->id(),
            'vehicle_id' => $vehicle->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/transports/' . $transport->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedTransport($transport),
            ]);
    }

    /** @test */
    function it_can_update_a_transport()
    {
        $account = $this->createAccount();
        $vehicle = $this->createVehicle([
            'account_id' => $account->id(),
        ]);
        $transport = $this->createTransport([
            'account_id' => $account->id(),
            'vehicle_id' => $vehicle->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/transports/' . $transport->id(), [
            'product' => 'updated product',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedTransport($transport, [
                    'product' => 'updated product',
                ]),
            ]);
    }

    /** @test */
    function it_can_delete_a_transport()
    {
        $account = $this->createAccount();
        $vehicle = $this->createVehicle([
            'account_id' => $account->id(),
        ]);
        $transport = $this->createTransport([
            'account_id' => $account->id(),
            'vehicle_id' => $vehicle->id(),
        ]);

        $this->seeInDatabase(Transport::TABLE, [
            'id' => $transport->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/transports/' . $transport->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Transport::TABLE, [
            'id' => $transport->id()
        ]);
    }
}
