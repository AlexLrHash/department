<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Profile\UpdateProfileRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Get user data
     *
     * @return UserResource
     */
    public function getUser()
    {
        return UserResource::make(Auth::user());
    }

    /**
     * Update profile data
     *
     * @param UpdateProfileRequest $request
     * @return UserResource
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->fill($request->only('name'));
        $user->save();

        return UserResource::make($user);
    }
}
