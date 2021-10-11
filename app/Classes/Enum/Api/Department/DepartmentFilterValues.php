<?php

namespace App\Classes\Enum\Api\Department;

use App\Classes\Enum\Enum;

class DepartmentFilterValues extends Enum
{
    // по имени
    const NAME = "name";

    // по заведующему
    const MANAGER = "manager";
}
