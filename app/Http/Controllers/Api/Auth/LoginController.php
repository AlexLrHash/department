<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login User
     *
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            abort(401, 'Неверные данные для входа');
        }

        $user = Auth::user();

        $token = $user->createtoken('token')->plainTextToken;

        return response([
            'user' => UserResource::make($user),
            'token' => $token
        ]);
    }
}
