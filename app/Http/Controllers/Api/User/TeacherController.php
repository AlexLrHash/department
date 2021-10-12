<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\Teacher\TeacherResource;
use App\Models\User;

class TeacherController extends Controller
{
    /**
     * Получение всех преподавалетей
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TeacherResource::collection(User::teachers()->get());
    }

    /**
     * Получение преподователя
     *
     * @param $secondId
     * @return TeacherResource
     */
    public function show($secondId)
    {
        return TeacherResource::make(User::teachers()->where('second_id', $secondId)->firstOrFail());
    }

    /**
     * Получение группы преподователей по отделению
     *
     * @return array
     */
    public function getGroupedTeachersByDepartments()
    {
        $groupedTeachersByDepartments = [];

        $teachers = User::teachers()->get();
        foreach ($teachers as $teacher) {
            $groupedTeachersByDepartments[$teacher->department->id][] = $teacher;
        }

        return $groupedTeachersByDepartments;
    }
}
