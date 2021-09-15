<?php

namespace App\Providers;

use App\Listeners\DisciplineListener;
use App\Models\Discipline;
use Illuminate\Support\ServiceProvider;

class DisciplineServiceProvider extends ServiceProvider
{
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
        $this->app->bind('disciplineService', 'App\Services\Api\Discipline\DisciplineService');

        $this->handler = new DisciplineListener();
        Discipline::observe($this->handler);
    }
}
