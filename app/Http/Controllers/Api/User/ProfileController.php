<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Profile\UpdateProfileRequest;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Получение пользователя
     *
     * @return UserResource
     */
    public function getUser()
    {
        return UserResource::make(Auth::user());
    }

    /**
     * Изменение профиля пользователя
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
     * Скачивание картинки
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
     * Изменение картинки
     *
     * @param Request $request
     * @return UserResource
     */
    public function uploadAvatar(Request $request)
    {

        $path = $request->file('avatar')->store('public/avatars/users');

        $user = Auth::user();
        $user->avatar = config('app.url') . str_replace('public', '/storage', $path);
        $user->save();

        $image = Image::make(str_replace('public', 'storage', $path))->fit(300, 300);
        $image->save();

        return UserResource::make($user);
    }
}
