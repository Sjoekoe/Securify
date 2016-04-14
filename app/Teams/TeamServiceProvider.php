<?php
namespace App\Teams;

use Illuminate\Support\ServiceProvider;

class TeamServiceProvider extends ServiceProvider
{
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(TeamRepository::class, function() {
            return new EloquentTeamRepository(new EloquentTeam());
        });
    }
    
    public function provides()
    {
        return [
            TeamRepository::class,
        ];
    }
}
