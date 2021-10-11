<?php

namespace App\Classes\Enum\Api\User;

use App\Classes\Enum\Enum;

class UserRoleEnum extends Enum
{
    // зав отделения
    const MANAGER = 'MANAGER';

    // преподаватель
    const TEACHER = 'TEACHER';

    // пользователь
    const USER = 'USER';

    // администратор
    const ADMIN = "ADMIN";
}
