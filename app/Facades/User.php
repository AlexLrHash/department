<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class User extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'userService';
    }
}
