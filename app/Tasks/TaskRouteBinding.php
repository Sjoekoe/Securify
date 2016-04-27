<?php
namespace App\Tasks;

use App\Http\AbstractRouteBinding;
use App\Http\RouteBinding;

class TaskRouteBinding extends AbstractRouteBinding implements RouteBinding
{
    /**
     * @var \App\Tasks\TaskRepository
     */
    private $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param int $id
     * @return \App\Tasks\Task|null
     */
    public function find($id)
    {
        return $this->tasks->find($id);
    }
}
