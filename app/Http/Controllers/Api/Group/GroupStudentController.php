<?php

namespace App\Http\Controllers\Api\Group;

use App\Classes\Enum\Api\User\Param\Student\StudentParamNameEnum;
use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Group\Student\AddStudentRequest;
use App\Http\Requests\Api\Group\Student\RemoveStudentRequest;
use App\Http\Resources\Api\Group\GroupResource;
use App\Http\Resources\Api\Group\Student\StudentResource;
use App\Models\TeacherGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupStudentController extends Controller
{
    /**
     * Добавление студента
     *
     * @param AddStudentRequest $request
     * @param $groupId
     * @return StudentResource
     */
    public function addStudent(AddStudentRequest $request, $groupId)
    {
        $group = TeacherGroup::where('teacher_id', Auth::user()->id)->findOrFail($groupId);

        $student = User::where('role', UserRoleEnum::STUDENT)->whereHas('params', function ($q) use ($request) {
            $q->where('name', StudentParamNameEnum::STUDENT_ID)->where('value', $request->get('number'));
        })->first();

        if ($group->students->contains($student->id)) {
            abort(422, trans('validation.groups.students.number.is'));
        }

        $group->students()->attach($student->id);

        return StudentResource::make($student);
    }

    public function removeStudent(RemoveStudentRequest $request, $groupId)
    {
        $group = TeacherGroup::where('teacher_id', Auth::user()->id)->findOrFail($groupId);

        $student = User::where('second_id', $request->get('student_id'))->firstOrFail();

        $group->students()->detach($student->id);

        return StudentResource::make($student);
    }
}
