<?php
namespace functional\Api\Tasks;

use App\Helpers\DefaultIncludes;
use App\Tasks\Task;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksTest extends \TestCase
{
    use DefaultIncludes, DatabaseTransactions;

    /** @test */
    function it_can_get_all_tasks_for_an_account()
    {
        $account = $this->createAccount();
        $task = $this->createTask([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/tasks', $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    $this->includedTask($task),
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
    function it_can_create_a_task()
    {
        $account = $this->createAccount();

        $start = Carbon::now();
        $end = Carbon::now();

        $this->post('/api/accounts/' . $account->id() . '/tasks', [
            'name' => 'test task',
            'expected_start' => $start->format('d-m-Y - H:i'),
            'expected_end' => $end->format('d-m-Y - H:i'),
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => [
                    'id' => DB::table(Task::TABLE)->first()->id,
                    'name' => 'test task',
                    'description' => null,
                    'expected_start' => $start->second(0)->toIso8601String(),
                    'expected_end' => $end->second(0)->toIso8601String(),
                    'finished' => null,
                    'accountRelation' => [
                        'data' => $this->includedAccount($account),
                    ],
                ],
            ]);
    }

    /** @test */
    function it_can_show_a_task()
    {
        $account = $this->createAccount();
        $task = $this->createTask([
            'account_id' => $account->id(),
        ]);

        $this->get('/api/accounts/' . $account->id() . '/tasks/' . $task->id(), $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedTask($task),
            ]);
    }

    /** @test */
    function it_can_update_a_task()
    {
        $account = $this->createAccount();
        $task = $this->createTask([
            'account_id' => $account->id(),
        ]);
        $now = Carbon::now();

        $this->put('/api/accounts/' . $account->id() . '/tasks/' . $task->id(), [
            'finished' => $now->format('d-m-Y - H:i'),
        ], $this->setJWTHeaders())
            ->seeJsonEquals([
                'data' => $this->includedTask($task, [
                    'finished' => $now->second(0)->toIso8601String(),
                ]),
            ]);
    }

    /** @test */
    function it_can_delete_a_task()
    {
        $account = $this->createAccount();
        $task = $this->createTask([
            'account_id' => $account->id(),
        ]);

        $this->seeInDatabase(Task::TABLE, [
            'id' => $task->id(),
        ]);

        $this->delete('/api/accounts/' . $account->id() . '/tasks/' . $task->id(), [], $this->setJWTHeaders())
            ->assertNoContent();

        $this->missingFromDatabase(Task::TABLE, [
            'id' => $task->id(),
        ]);
    }
}
