<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class JwtAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'JwtAuth';
    }
}
