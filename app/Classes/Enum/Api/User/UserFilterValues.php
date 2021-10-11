<?php

namespace App\Classes\Enum\Api\User;

use App\Classes\Enum\Enum;

class UserFilterValues extends Enum
{
    // по имени
    const NAME = "name";

    // по почте
    const EMAIL = "email";

    // по роли
    const ROLE = "role";
}
