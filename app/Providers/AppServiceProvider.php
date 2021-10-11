<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(UserServiceProvider::class);
        $this->app->register(DepartmentServiceProvider::class);
        $this->app->register(DisciplineServiceProvider::class);
        $this->app->register(SocialServiceProvider::class);
        $this->app->register(ManagerServiceProvider::class);
        $this->app->register(TeacherServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
