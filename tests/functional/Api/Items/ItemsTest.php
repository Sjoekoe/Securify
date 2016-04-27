<?php
namespace functional\Api\Items;

use App\Helpers\DefaultIncludes;
use App\Items\Item;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemsTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_items_for_an_account()
    {
        $account = $this->createAccount();
        $item = $this->createItem([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/items', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedItem($item),
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
    function it_can_create_an_item()
    {
        $account = $this->createAccount();

        $this->post('/api/accounts/' . $account->id() . '/items', [
            'name' => 'test name',
            'description' => 'bla bla',
            'code' => '1234',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(Item::TABLE)->first()->id,
                    'name' => 'test name',
                    'description' => 'bla bla',
                    'code' => '1234',
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_show_an_item()
    {
        $account = $this->createAccount();
        $item = $this->createItem([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/items/' . $item->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedItem($item),
            ]);
    }

    /** @test */
    function it_can_update_an_item()
    {
        $account = $this->createAccount();
        $item = $this->createItem([
            'account_id' => $account->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/items/' . $item->id(), [
            'name' => 'updated name',
            'code' => 'update 123',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedItem($item, [
                    'name' => 'updated name',
                    'code' => 'update 123',
                ]),
            ]);
    }

    /** @test */
    function it_can_delete_an_item()
    {
        $account = $this->createAccount();
        $item = $this->createItem([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(Item::TABLE, [
            'id' => $item->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/items/' . $item->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Item::TABLE, [
            'id' => $item->id(),
        ]);
    }
}
