<?php

namespace App\Http\Controllers\Api\Admin;

use App\Classes\Enum\Api\User\UserRoleEnum;
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
     * Get Admin
     *
     * @return UserResource
     */
    public function admin()
    {
        return UserResource::make(Auth::user());
    }

    /**
     * Get Users
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUsers()
    {
        return UserResource::collection(User::where('role', UserRoleEnum::TEACHER)->get());
    }

    /**
     * Get User
     *
     * @param $userSecondId
     * @return UserResource
     */
    public function getUser($userSecondId)
    {
        return UserResource::make(User::where('role', UserRoleEnum::TEACHER)->where('second_id', $userSecondId)->firstOrFail());
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

    /**
     * Add Discipline
     *
     * @param $teacherSecondId
     * @param $disciplineSecondId
     * @return UserResource
     */
    public function addDiscipline($teacherSecondId, $disciplineSecondId)
    {
        $user = User::where('second_id', $teacherSecondId)->where('role', UserRoleEnum::TEACHER)->firstOrFail();
        $user->disciplines()->attach(Discipline::where('second_id', $disciplineSecondId)->firstOrFail()->id);

        return UserResource::make($user);
    }

    /**
     * Remove Discipline
     *
     * @param $teacherSecondId
     * @param $disciplineSecondId
     * @return UserResource
     */
    public function removeDiscipline($teacherSecondId, $disciplineSecondId)
    {
        $user = User::where('second_id', $teacherSecondId)->where('role', UserRoleEnum::TEACHER)->firstOrFail();
        $user->disciplines()->detach(Discipline::where('second_id', $disciplineSecondId)->firstOrFail()->id);

        return UserResource::make($user);
    }
}
