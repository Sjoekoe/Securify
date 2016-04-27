<?php
namespace App\Tasks;

use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(TaskRepository::class, function() {
            return new EloquentTaskRepository(new EloquentTask());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            TaskRepository::class,
        ];
    }
}
