<?php
namespace functional\Api;

use App\Helpers\DefaultIncludes;
use App\Users\User;
use Carbon\Carbon;

class UsersTest extends \TestCase
{
    use DefaultIncludes;

    /** @test */
    function it_can_get_all_users_paginated()
    {
        $user = $this->createUser();

        $this->get('/api/users')
            ->seeJsonEquals([
                'data' =>[
                    $this->includedUser($user)
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
    function it_can_create_a_user()
    {
        $now = Carbon::now();

        $this->post('/api/users', [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->seeJsonEquals([
            'data' => [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@doe.com',
                'created_at' => $now->toIso8601String(),
                'updated_at' => $now->toIso8601String(),
            ]
        ]);
    }

    /** @test */
    function it_can_show_a_user()
    {
        $user = $this->createUser();

        $this->get('/api/users/' . $user->id())
            ->seeJsonEquals([
                'data' => $this->includedUser($user),
            ]);
    }

    /** @test */
    function it_can_update_a_user()
    {
        $user = $this->createUser();

        $this->put('/api/users/' . $user->id(), [
            'name' => 'Foo person',
            'email' => 'foo@bar.com',
        ])->seeJsonEquals([
            'data' => $this->includedUser($user, [
                'name' => 'Foo person',
                'email' => 'foo@bar.com',
            ])
        ]);
    }

    /** @test */
    function it_can_delete_a_user()
    {
        $user = $this->createUser();

        $this->seeInDatabase(User::TABLE, [
            'id' => $user->id(),
        ]);

        $this->delete('/api/users/' . $user->id())
            ->assertNoContent();

        $this->missingFromDatabase(User::TABLE, [
            'id' => $user->id(),
        ]);
    }
}
