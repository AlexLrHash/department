<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Manager extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'managerService';
    }
}
