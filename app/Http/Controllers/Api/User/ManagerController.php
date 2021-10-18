<?php

namespace App\Http\Controllers\Api\User;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\Manager\ManagerResource;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;

class ManagerController extends Controller
{
    /**
     * Получение всех зав отделений
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection(User::where('role', UserRoleEnum::MANAGER)->get());
    }

    /**
     * Получение зав отделения
     *
     * @param $secondId
     * @return UserResource
     */
    public function show($secondId)
    {
        return  ManagerResource::make(User::where('role', UserRoleEnum::MANAGER)->where('second_id', $secondId)->firstOrFail());
    }
}
