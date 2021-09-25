<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\DepartmentResource;
use App\Http\Resources\Api\Admin\Discipline\DisciplineResource;
use App\Http\Resources\Api\Admin\User\UserResource;
use App\Models\Department;
use App\Models\Discipline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * @return UserResource
     */
    public function admin()
    {
        return UserResource::make(Auth::user());
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUsers()
    {
        return UserResource::collection(User::get());
    }

    /**
     * Получение дисциплин
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getDisciplines()
    {
        return DisciplineResource::collection(Discipline::get());
    }

    /**
     * Получение отделений
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getDepartments()
    {
        return DepartmentResource::collection(Department::get());
    }
}
