<?php
namespace App\Api\Http\Controllers\Accounts\Todos;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Todos\Requests\ShowTodoRequest;
use App\Api\Todos\Requests\StoreTodoRequest;
use App\Api\Todos\Requests\UpdateTodoRequest;
use App\Api\Todos\TodoTransformer;
use App\Todos\Todo;
use App\Todos\TodoRepository;

class TodoController extends Controller
{
    /**
     * @var \App\Todos\TodoRepository
     */
    private $todos;

    public function __construct(TodoRepository $todos)
    {
        $this->todos = $todos;
    }

    public function index(Account $account)
    {
        $todos = $this->todos->findByAccountAndUserPaginated($account, auth()->user());

        return $this->response()->paginator($todos, new TodoTransformer());
    }

    public function store(StoreTodoRequest $request, Account $account)
    {
        $todo = $this->todos->create($account, auth()->user(), $request->all());

        return $this->response()->item($todo, new TodoTransformer());
    }

    public function show(ShowTodoRequest $request, Account $account, Todo $todo)
    {
        return $this->response()->item($todo, new TodoTransformer());
    }

    public function update(UpdateTodoRequest $request, Account $account, Todo $todo)
    {
        $todo = $this->todos->update($todo, $request->all());

        return $this->response()->item($todo, new TodoTransformer());
    }

    public function delete(ShowTodoRequest $request, Account $account, Todo $todo)
    {
        $this->todos->delete($todo);

        return $this->response()->noContent();
    }
}
