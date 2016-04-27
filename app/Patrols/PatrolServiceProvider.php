<?php
namespace App\Patrols;

use App\Patrols\Checkpoints\CheckpointRepository;
use App\Patrols\Checkpoints\EloquentCheckpoint;
use App\Patrols\Checkpoints\EloquentCheckpointRepository;
use Illuminate\Support\ServiceProvider;

class PatrolServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(PatrolRepository::class, function() {
            return new EloquentPatrolRepository(new EloquentPatrol());
        });
        
        $this->app->singleton(CheckpointRepository::class, function() {
            return new EloquentCheckpointRepository(new EloquentCheckpoint());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            PatrolRepository::class,
            CheckpointRepository::class,
        ];
    }
}
