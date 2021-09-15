<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register User
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response([
            'user'  => UserResource::make($user),
            'token' => $token
        ]);
    }
}
