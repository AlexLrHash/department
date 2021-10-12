<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use UserService;

class UserListener
{
    /**
     * Создание пользователя
     *
     * @param User $user
     */
    public function creating(User $user)
    {
        $user->second_id = UserService::generateSecondId();
    }
}
