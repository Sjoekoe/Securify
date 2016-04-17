<?php
namespace App\Visitors;

use Illuminate\Support\ServiceProvider;

class VisitorServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(VisitorRepository::class, function() {
            return new EloquentVisitorRepository(new EloquentVisitor());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            VisitorRepository::class,
        ];
    }
}
