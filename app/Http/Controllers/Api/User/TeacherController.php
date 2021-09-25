<?php

namespace App\Http\Controllers\Api\User;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Получение всех преподавалетей
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection(User::where('role', UserRoleEnum::TEACHER)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Получение преподователя
     *
     * @param $secondId
     * @return UserResource
     */
    public function show($secondId)
    {
        return UserResource::make(User::where('role', UserRoleEnum::TEACHER)->where('second_id', $secondId)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Получение группы преподователей по отделению
     *
     * @return array
     */
    public function getGroupedTeachersByDepartments()
    {
        $groupedTeachersByDepartments = [];

        $teachers = User::where('role', UserRoleEnum::TEACHER)->get();
        foreach ($teachers as $teacher) {
            $groupedTeachersByDepartments[$teacher->department->id][] = $teacher;
        }

        return $groupedTeachersByDepartments;
    }
}
