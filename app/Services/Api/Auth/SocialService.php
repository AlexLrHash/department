<?php

namespace App\Services\Api\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SocialService
{
    /**
     * Сохраняем данные
     *
     * @param $socialiteUser
     * @return mixed
     */
    public function saveSocialData($socialiteUser)
    {
        $email = $socialiteUser->getEmail();
        $name = $socialiteUser->getName();
//        $avatar = $socialiteUser->getAvatar();

        if ($user = User::where('email', $email)->first()) {
            $user->name = $name;
            $user->save();
        } else {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('secret')
            ]);
        }

        return $user;
    }
}
