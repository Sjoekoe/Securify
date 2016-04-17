<?php
namespace App\Http;

use App\Http\Validation\UrlHostValidator;
use App\Validation\ExtendsValidator;
use Illuminate\Support\ServiceProvider;

class HttpServiceProvider extends ServiceProvider
{
    use ExtendsValidator;

    protected $rules = [
        UrlHostValidator::class,
    ];

    public function register()
    {
        // TODO: Implement register() method.
    }
}
