<?php
namespace functional\Api;

use App\Users\User;
use Carbon\Carbon;

class UsersTest extends \TestCase
{
    /** @test */
    function it_can_get_all_users_paginated()
    {
        $user = $this->createUser();

        $this->get('/api/users')
            ->seeJsonEquals([
                'data' =>[
                    [
                        'id' => $user->id(),
                        'name' => $user->name(),
                        'email' => $user->email(),
                        'created_at' => $user->createdAt()->toIso8601String(),
                        'updated_at' => $user->updatedAt()->toIso8601String(),
                    ]
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
            'email' => 'john@doe.com'
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
                'data' => [
                    'id' => $user->id(),
                    'name' => $user->name(),
                    'email' => $user->email(),
                    'created_at' => $user->createdAt()->toIso8601String(),
                    'updated_at' => $user->updatedAt()->toIso8601String(),
                ],
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
            'data' => [
                'id' => $user->id(),
                'name' => 'Foo person',
                'email' => 'foo@bar.com',
                'created_at' => $user->createdAt()->toIso8601String(),
                'updated_at' => $user->updatedAt()->toIso8601String(),
            ],
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
