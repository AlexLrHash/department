<?php

namespace App\Providers;

use App\Listeners\UserListener;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
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
        $this->app->bind('userService', 'App\Services\Api\User\UserService');

        $this->handler = new UserListener();
        User::observe($this->handler);
    }
}
