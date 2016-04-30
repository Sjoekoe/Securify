<?php
namespace App\Transports;

use Illuminate\Support\ServiceProvider;

class TransportServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(TransportRepository::class, function() {
            return new EloquentTransportRepository(new EloquentTransport());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            TransportRepository::class,
        ];
    }
}
