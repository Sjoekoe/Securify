<?php
namespace functional\Api\Items;

use App\Helpers\DefaultIncludes;
use App\Items\Groups\ItemGroup;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemGroupTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_item_groups_for_an_account()
    {
        $account = $this->createAccount();
        $itemGroup = $this->createItemGroup([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/item-groups', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedItemGroup($itemGroup),
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
    function it_can_create_an_item_group()
    {
        $account = $this->createAccount();

        $this->post('/api/accounts/' . $account->id() . '/item-groups', [
            'name' => 'Test name',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(ItemGroup::TABLE)->first()->id,
                    'name' => 'Test name',
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_show_an_item_group()
    {
        $account = $this->createAccount();
        $itemGroup = $this->createItemGroup([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/item-groups/' . $itemGroup->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedItemGroup($itemGroup),
            ]);
    }

    /** @test */
    function it_can_update_an_item_group()
    {
        $account = $this->createAccount();
        $itemGroup = $this->createItemGroup([
            'account_id' => $account->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/item-groups/' . $itemGroup->id(), [
            'name' => 'Updated name',
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedItemGroup($itemGroup, [
                    'name' => 'Updated name',
                ])
            ]);
    }

    /** @test */
    function it_can_delete_an_item_group()
    {
        $account = $this->createAccount();
        $itemGroup = $this->createItemGroup([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(ItemGroup::TABLE, [
            'id' => $itemGroup->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/item-groups/' . $itemGroup->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(ItemGroup::TABLE, [
            'id' => $itemGroup->id(),
        ]);
    }
}
