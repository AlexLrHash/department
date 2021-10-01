<?php

namespace App\Classes\Enum;

class Enum
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function lists()
    {
        return (new \ReflectionClass(get_called_class()))->getConstants();
    }
}
