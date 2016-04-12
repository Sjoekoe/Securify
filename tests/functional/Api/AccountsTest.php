<?php
namespace functional\Api;

use App\Helpers\DefaultIncludes;
use Carbon\Carbon;

class AccountsTest extends \TestCase
{
    use DefaultIncludes;

    /** @test */
    function it_can_get_all_accounts_paginated()
    {
        $account = $this->createAccount();

        $this->get('/api/accounts')
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
        ])->seeJsonEquals([
            'data' => [
                'id' => 1,
                'name' => 'Test Account',
                'vat' => '456789',
                'website' => 'www.test.com',
                'created_at' => $now->toIso8601String(),
                'updated_at' => $now->toIso8601String(),
            ]
        ]);
    }
}
