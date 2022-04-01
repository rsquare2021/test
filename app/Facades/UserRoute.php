<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UserRoute extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "user_route";
    }
}