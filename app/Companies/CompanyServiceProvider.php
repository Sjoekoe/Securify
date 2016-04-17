<?php
namespace App\Companies;

use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(CompanyRepository::class, function() {
            return new EloquentCompanyRepository(new EloquentCompany());
        });
    }
    
    public function provides()
    {
        return [
            CompanyRepository::class,
        ];
    }
}
