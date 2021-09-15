<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Discipline extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'disciplineService';
    }
}
