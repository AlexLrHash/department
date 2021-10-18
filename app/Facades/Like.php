<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Like extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'likeService';
    }
}
