<?php

namespace App\Services\Api\Department;

use App\Models\Department;
use App\Models\User;

class DepartmentService
{
    /**
     * Generate second id for department
     *
     * @return int
     */
    public function generateSecondId()
    {
        $exists = true;
        while ($exists) {
            $second_id = mt_rand(10000000, 99999999);
            $exists = Department::where('second_id', $second_id)->exists();
        }

        return $second_id;
    }
}
