<?php

namespace App\Services\Api\Discipline;

use App\Models\Department;

class DisciplineService
{
    /**
     * Generate second id for discipline
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
