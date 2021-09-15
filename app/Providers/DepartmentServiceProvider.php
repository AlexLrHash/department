<?php

namespace App\Providers;

use App\Listeners\DepartmentListener;
use App\Models\Department;
use Illuminate\Support\ServiceProvider;

class DepartmentServiceProvider extends ServiceProvider
{
    private $handler;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('departmentService', 'App\Services\Api\Department\DepartmentService');

        $this->handler = new DepartmentListener();
        Department::observe($this->handler);
    }
}
