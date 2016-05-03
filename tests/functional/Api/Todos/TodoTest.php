<?php
namespace functional\Api\Todos;

use App\Helpers\DefaultIncludes;
use App\Todos\Todo;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TodoTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_todos_for_an_account()
    {
        $account = $this->createAccount();
        $user = $this->loginAsUser();
        $todo = $this->createTodo([
            'account_id' => $account->id(),
            'user_id' => $user->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/todos', $this->setJWTHeaders($user))
            ->seeJsonEquals([
                'data' => [
                    $this->includedTodo($todo),
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
    function it_can_create_a_todo()
    {
        $account = $this->createAccount();
        $user = $this->loginAsUser();
        $now = Carbon::now();

        $this->post('/api/accounts/' . $account->id() . '/todos', [
            'name' => 'Test Name',
            'date' => $now->format('d/m/Y'),
        ], $this->setJWTHeaders($user))
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(Todo::TABLE)->first()->id,
                    'name' => 'Test Name',
                    'date' => $now->toIso8601String(),
                    'finished' => false,
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                    'userRelation' => [
                        'data' => $this->includedUser($user),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_not_show_a_todo_that_does_not_belong_to_the_account()
    {
        $account = $this->createAccount();
        $user = $this->loginAsUser();
        $todo = $this->createTodo([
            'account_id' => $account->id(),
            'user_id' => $user->id(),
        ]);
        $account2 = $this->createAccount();

        $this->get('/api/accounts/' . $account2->id() . '/todos/' . $todo->id(), $this->setJWTHeaders($user))
            ->assertForbidden();
    }


    /** @test */
    function it_can_show_a_todo()
    {
        $account = $this->createAccount();
        $user = $this->loginAsUser();
        $todo = $this->createTodo([
            'account_id' => $account->id(),
            'user_id' => $user->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/todos/' . $todo->id(), $this->setJWTHeaders($user))
            ->seeJsonEquals([
                'data' => $this->includedTodo($todo),
            ]);
    }

    /** @test */
    function it_can_update_a_todo()
    {
        $account = $this->createAccount();
        $user = $this->loginAsUser();
        $todo = $this->createTodo([
            'account_id' => $account->id(),
            'user_id' => $user->id(),
        ]);

        $this->put('/api/accounts/' . $account->id() . '/todos/' . $todo->id(), [
            'name' => 'updated name',
            'finished' => true,
        ], $this->setJWTHeaders($user))
            ->seeJsonEquals([
                'data' => $this->includedTodo($todo, [
                    'name' => 'updated name',
                    'finished' => true,
                ]),
            ]);
    }

    /** @test */
    function it_can_delete_a_todo()
    {
        $account = $this->createAccount();
        $user = $this->loginAsUser();
        $todo = $this->createTodo([
            'account_id' => $account->id(),
            'user_id' => $user->id(),
        ]);

        $this->seeInDatabase(Todo::TABLE, [
            'id' => $todo->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/todos/' . $todo->id(), [], $this->setJWTHeaders($user))
            ->assertNoContent();

        $this->missingFromDatabase(Todo::TABLE, [
            'id' => $todo->id(),
        ]);
    }
}
