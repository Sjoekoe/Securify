<?php
namespace App\Employees;

use Illuminate\Support\ServiceProvider;

class EmployeeServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(EmployeeRepository::class, function() {
            return new EloquentEmployeeRepository(new EloquentEmployee());
        });
    }
    
    public function provides()
    {
        return [
            EmployeeRepository::class,
        ];
    }
}
