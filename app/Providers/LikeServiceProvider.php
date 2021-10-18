<?php

namespace App\Providers;

use App\Listeners\LikeListener;
use App\Models\Like;
use Illuminate\Support\ServiceProvider;

class LikeServiceProvider extends ServiceProvider
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
        $this->app->bind('likeService', 'App\Services\Api\Like\LikeService');

        $this->handler = new LikeListener();
        Like::observe($this->handler);
    }
}
