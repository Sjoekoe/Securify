<?php
namespace App\JWT;

use Illuminate\Support\ServiceProvider;

class JWTServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->bind(TokenGenerator::class, TymonTokenGenerator::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [TokenGenerator::class];
    }
}
