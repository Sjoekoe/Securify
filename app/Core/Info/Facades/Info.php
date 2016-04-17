<?php
namespace App\Core\Info\Facades;

use Illuminate\Support\Facades\Facade;

class Info extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \App\Core\Info\Info::class;
    }
}
