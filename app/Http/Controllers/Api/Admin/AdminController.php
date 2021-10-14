<?php

namespace App\Http\Controllers\Api\Admin;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Filters\Admin\DepartmentFilter;
use App\Http\Filters\Admin\DisciplineFilter;
use App\Http\Filters\Admin\UserFilter;
use App\Http\Requests\Api\Admin\Department\DepartmentRequest;
use App\Http\Requests\Api\Admin\Discipline\CreateDisciplineRequest;
use App\Http\Requests\Api\Admin\Discipline\DisciplineRequest;
use App\Http\Requests\Api\Admin\User\CreateUserRequest;
use App\Http\Requests\Api\Admin\User\UpdateUserRequest;
use App\Http\Requests\Api\Admin\User\UserRequest;
use App\Http\Requests\Api\User\Discipline\AddDisciplineRequest;
use App\Http\Resources\Api\Admin\Department\DepartmentResource;
use App\Http\Resources\Api\Admin\Discipline\DisciplineResource;
use App\Http\Resources\Api\Admin\User\UserResource;
use App\Models\Department;
use App\Models\Discipline;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
    public function getUsers(UserRequest $request)
    {
        $filter = app()->make(UserFilter::class, ['queryParams' => array_filter($request->all())]);

        $users = User::filter($filter)->get();

        return UserResource::collection($users);
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
    public function getDisciplines(DisciplineRequest $request)
    {
        $filter = app()->make(DisciplineFilter::class, ['queryParams' => array_filter($request->all())]);

        $disciplines = Discipline::filter($filter)->get();

        return DisciplineResource::collection($disciplines);
    }

    /**
     * Получение отделений
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getDepartments(DepartmentRequest $request)
    {
        $filter = app()->make(DepartmentFilter::class, ['queryParams' => $request->all()]);

        $departments = Department::filter($filter)->get();

        return DepartmentResource::collection($departments);
    }

    /**
     * Add Discipline
     *
     * @param $teacherSecondId
     * @param $disciplineSecondId
     * @return UserResource
     */
    public function addDiscipline(AddDisciplineRequest $request, $teacherSecondId, $disciplineSecondId)
    {
        $user = User::where('second_id', $teacherSecondId)->where('role', UserRoleEnum::TEACHER)->firstOrFail();

        $discipline = Discipline::where('second_id', $disciplineSecondId)->firstOrFail();

        if (!$user->disciplines->contains($discipline->id)) {
            $user->disciplines()->attach($discipline->id);
        }

        $user->load(['disciplines']);

        $discipline = $user->disciplines->find($discipline->id)->pivot;
        $discipline->number_of_labs = $request->get('number_of_labs');
        $discipline->number_of_practices = $request->get('number_of_practices');
        $discipline->save();

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

        $discipline = Discipline::where('second_id', $disciplineSecondId)->firstOrFail();

        if ($user->disciplines->contains($discipline->id)) {
            $user->disciplines()->detach($discipline->id);
        }

        $user->load(['disciplines']);

        return UserResource::make($user);
    }

    /**
     * Создание дисциплины
     *
     * @param CreateDisciplineRequest $request
     * @return DisciplineResource
     */
    public function createDiscipline(CreateDisciplineRequest $request)
    {
        $discipline = Discipline::create([
            'name' => $request->get('name'),
            'department_id' => $request->get('department_id'),
            'description' => $request->get('description', null),
        ]);

        return DisciplineResource::make($discipline);
    }

    /**
     * Удаление дисциплины
     *
     * @param $disciplineSecondId
     * @return DisciplineResource
     */
    public function deleteDiscipline($disciplineSecondId)
    {
        $discipline = Discipline::where('second_id', $disciplineSecondId)->firstOrFail();
        $discipline->delete();

        return DisciplineResource::make($discipline);
    }

    /**
     * Изменение дисциплины
     *
     * @param CreateDisciplineRequest $request
     * @param $disciplineSecondId
     * @return DisciplineResource
     */
    public function updateDiscipline(CreateDisciplineRequest $request, $disciplineSecondId)
    {
        $discipline = Discipline::where('second_id', $disciplineSecondId)->firstOrFail();
        $discipline->fill($request->only('name', 'department_id', 'description'));
        $discipline->save();

        return DisciplineResource::make($discipline);
    }

    /**
     * Создание пользователя
     *
     * @param CreateUserRequest $request
     */
    public function createUser(CreateUserRequest $request)
    {
//        $path = $request->file('avatar')->store('public/avatars/users');

        $user = User::create([
            'name'     => $request->get('name'),
            'role'     => $request->get('role'),
            'email'    => $request->get('email'),
            'phone'    => preg_replace('/[^0-9]/', '', $request->get('phone')),
            'password' => Hash::make(Str::random(24)),
//            'avatar' => config('app.url') . str_replace('public', '/storage', $path)
        ]);

        return UserResource::make($user);
    }

    /**
     * Удаление пользователя
     *
     * @param $userSecondId
     * @return UserResource
     */
    public function deleteUser($userSecondId)
    {
        $user = User::where('second_id', $userSecondId)->firstOrFail();
        $user->delete();

        return UserResource::make($user);
    }

    /**
     * Изменение пользователя
     *
     * @param UpdateUserRequest $request
     * @param $userSecondId
     * @return UserResource
     */
    public function updateUser(UpdateUserRequest $request, $userSecondId)
    {
        $user = User::where('second_id', $userSecondId)->firstOrFail();

        $user->fill($request->only('name', 'role', 'email', 'phone'));
        $user->save();

        return UserResource::make($user);
    }
}
