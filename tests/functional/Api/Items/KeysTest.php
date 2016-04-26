<?php
namespace functional\Api\Items;

use App\Helpers\DefaultIncludes;
use App\Keys\Key;

class KeysTest extends \TestCase
{
    use DefaultIncludes;

    /** @test */
    function it_can_show_all_keys_for_an_account_paginated()
    {
        $account = $this->createAccount();
        $key = $this->createKey([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/keys', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedKey($key),
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
    function it_can_create_a_key()
    {
        $account = $this->createAccount();

        $this->post('/api/accounts/' . $account->id() . '/keys', [
            'name' => 'Test Key',
            'key_code' => 'ED-45',
            'number' => 15,
            'description' => 'Lorem ipsum',
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => [
                'id' => 1,
                'name' => 'Test Key',
                'key_code' => 'ED-45',
                'number' => 15,
                'description' => 'Lorem ipsum',
                'accountRelation' => [
                    'data' => $this->includedAccount($account),
                ],
            ],
        ]);
    }

    /** @test */
    function it_can_show_a_key()
    {
        $account = $this->createAccount();
        $key = $this->createKey([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/keys/' . $key->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedKey($key),
            ]);
    }

    /** @test */
    function it_can_update_a_key()
    {
        $account = $this->createAccount();
        $key = $this->createKey([
            'account_id' => $account->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/keys/' . $key->id(), [
            'name' => 'updated key',
            'number' => 20,
            'key_code' => '345',
        ], $this->setJWTHeaders())->seeJsonEquals([
            'data' => $this->includedKey($key, [
                'number' => 20,
                'name' => 'updated key',
                'key_code' => '345',
            ])
        ]);
    }

    /** @test */
    function it_can_delete_a_key()
    {
        $account = $this->createAccount();
        $key = $this->createKey([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(Key::TABLE, [
            'id' => $key->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/keys/' . $key->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Key::TABLE, [
            'id' => $key->id(),
        ]);
    }
}
