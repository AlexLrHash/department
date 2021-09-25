<?php

namespace App\Http\Controllers\Api\Auth;

use App\Facades\Social;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserResource;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    /**
     * Получение страницы драйвера
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    /**
     * Web hook
     *
     * @return UserResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function callback()
    {
        $socialiteUser = Socialite::driver('vkontakte')->user();

        if ($user = Social::saveSocialData($socialiteUser)) {
            $token = $user->createToken('token')->plainTextToken;

            return response([
                'token' => $token,
                'user' => UserResource::make($user),
            ]);
        }

        return response([
            'message' => 'invalid_credentials'
        ], 400);
    }
}
