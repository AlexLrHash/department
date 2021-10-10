<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Profile\UpdateProfileRequest;
use App\Http\Requests\Api\User\Profile\UploadAvatarRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Download Avatar
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadAvatar(Request $request)
    {
        $avatarUrl = $request->get('path');
//        if (!Storage::exists($avatarUrl)) {
//            abort(404, 'Не найдена картинка по такому url');
//        };

        $headers['Content-Type'] = 'image/jpg';

        return response()->download(base_path('storage/app/public/avatars/users/' . $avatarUrl));
    }

    /**
     * Upload Image
     *
     * @param Request $request
     * @return UserResource
     */
    public function uploadAvatar(Request $request)
    {
        $path = $request->file('avatar')->store('public/avatars/users');

        $user = Auth::user();
        $user->avatar = $path;
        $user->save();

        return UserResource::make($user);
    }
}
