<?php

namespace App\Classes\Enum\Api\User;

class UserStatusEnum
{
    // только что зарегистрировался, почта не подтверждена
    const NEW = "NEW";

    // активный, почта потдверждена
    const ACTIVE = "ACTIVE";

    // заблокирован
    const BLOCKED = "BLOCKED";
}
