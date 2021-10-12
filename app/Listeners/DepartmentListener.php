<?php

namespace App\Listeners;

use App\Models\Department;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DepartmentService;

class DepartmentListener
{
    /**
     * Создание отделения
     *
     * @param Department $department
     */
    public function creating(Department $department)
    {
        $department->second_id = DepartmentService::generateSecondId();
    }
}
