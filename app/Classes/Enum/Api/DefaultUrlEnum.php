<?php

namespace App\Classes\Enum\Api;

use App\Classes\Enum\Enum;

class DefaultUrlEnum extends Enum
{
    // аватар пользователя
    const USER_DEFAULT_AVATAR_URL = 'http://department.biz/storage/avatars/users/default.png';

    // задний фон для отделения
    const DEPARTMENT_DEFAULT_BACKGROUND_URL = 'http://department.biz/storage/backgrounds/departments/default.jpg';

    // задний фон для дисциплины
    const DISCIPLINE_DEFAULT_BACKGROUND_URL = 'http://department.biz/storage/backgrounds/disciplines/default.png';
}
