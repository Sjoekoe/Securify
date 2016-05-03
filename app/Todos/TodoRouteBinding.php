<?php
namespace App\Todos;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class TodoRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Todos\TodoRepository
     */
    private $todos;

    public function __construct(TodoRepository $todos)
    {
        $this->todos = $todos;
    }

    /**
     * @param int $id
     * @return \App\Todos\Todo|null
     */
    public function find($id)
    {
        return $this->todos->find($id);
    }
}
