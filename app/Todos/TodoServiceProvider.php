<?php
namespace App\Todos;

use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(TodoRepository::class, function () {
            return new EloquentTodoRepository(new EloquentTodo());
        });
    }
    
    public function provides()
    {
        return [
            TodoRepository::class,
        ];
    }
}
