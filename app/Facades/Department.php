<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Department extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'departmentService';
    }
}
