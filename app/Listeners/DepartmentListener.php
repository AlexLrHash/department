<?php

namespace App\Listeners;

use App\Models\Department;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DepartmentService;

class DepartmentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }

    /**
     * Creating Department
     *
     * @param Department $department
     */
    public function creating(Department $department)
    {
        $department->second_id = DepartmentService::generateSecondId();
    }
}
