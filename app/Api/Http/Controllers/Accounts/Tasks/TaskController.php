<?php
namespace App\Api\Http\Controllers\Accounts\Tasks;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Tasks\Requests\StoreTaskRequest;
use App\Api\Tasks\Requests\UpdateTaskRequest;
use App\Api\Tasks\TaskTransformer;
use App\Tasks\Task;
use App\Tasks\TaskRepository;

class TaskController extends Controller
{
    /**
     * @var \App\Tasks\TaskRepository
     */
    private $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    public function index(Account $account)
    {
        $tasks = $this->tasks->findByAccountPaginated($account);

        return $this->response()->paginator($tasks, new TaskTransformer());
    }
    
    public function store(StoreTaskRequest $request, Account $account)
    {
        $task = $this->tasks->create($account, $request->all());
        
        return $this->response()->item($task, new TaskTransformer());
    }

    public function show(Account $account, Task $task)
    {
        return $this->response()->item($task, new TaskTransformer());
    }
    
    public function update(UpdateTaskRequest $request, Account $account, Task $task)
    {
        $task = $this->tasks->update($task, $request->all());
        
        return $this->response()->item($task, new TaskTransformer());
    }
    
    public function delete(Account $account, Task $task)
    {
        $this->tasks->delete($task);
        
        return $this->response()->noContent();
    }
}
