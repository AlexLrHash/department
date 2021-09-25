<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Social extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'socialService';
    }
}
