<?php
namespace functional\Api;

use App\Accounts\Account;
use App\Helpers\DefaultIncludes;
use Carbon\Carbon;

class AccountsTest extends \TestCase
{
    use DefaultIncludes;

    /** @test */
    function it_can_get_all_accounts_paginated()
    {
        $account = $this->createAccount();

        $this->get('/api/accounts', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedAccount($account)
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
    function it_can_create_an_account()
    {
        $now = Carbon::now();

        $this->post('/api/accounts', [
            'name' => 'Test Account',
            'vat' => '456789',
            'website' => 'www.test.com',
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => [
                'id' => 1,
                'name' => 'Test Account',
                'vat' => '456789',
                'website' => 'www.test.com',
                'date_format' => 'd-m-y',
                'time_format' => 'HH:MM',
                'created_at' => $now->toIso8601String(),
                'updated_at' => $now->toIso8601String(),
            ]
        ]);
    }

    /** @test */
    function it_can_show_an_account()
    {
        $account = $this->createAccount();

        $this->get('/api/accounts/' . $account->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedAccount($account),
            ]);
    }

    /** @test */
    function it_can_update_an_account()
    {
        $account = $this->createAccount();

        $this->put('/api/accounts/' . $account->id(), [
            'name' => 'Updated account',
            'website' => 'www.update.com',
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => $this->includedAccount($account, [
                'name' => 'Updated account',
                'website' => 'www.update.com',
            ])
        ]);
    }

    /** @test */
    function it_can_delete_an_account()
    {
        $account = $this->createAccount();

        $this->seeInDatabase(Account::TABLE, [
            'id' => $account->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Account::TABLE, [
            'id' => $account->id(),
        ]);
    }
}
