<?php

namespace App\Classes\Enum\Api\User\Param\Student;

use App\Classes\Enum\Enum;

class StudentParamTypeEnum extends Enum
{
    // курс
    const COURSE = "string";

    // отделение
    const DEPARTMENT_ID = "string";

    // группа
    const GROUP = "string";

    // номер студенческого
    const STUDENT_ID = 'string';
}
