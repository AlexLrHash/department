<?php

namespace App\Http\Controllers\Api\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Group\CreateGroupRequest;
use App\Http\Resources\Api\Group\GroupResource;
use App\Models\Discipline;
use App\Models\TeacherGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Получаем группы
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getGroups()
    {
        $currentUser = Auth::user();

        return GroupResource::collection($currentUser->getTeacherGroups);
    }

    /**
     * Получаем группу
     *
     * @param $groupId
     * @return GroupResource
     */
    public function getGroup($groupId)
    {
        $group = TeacherGroup::where('teacher_id', Auth::user()->id)->findOrFail($groupId);

        return GroupResource::make($group);
    }

    /**
     * Создание группы
     *
     * @param CreateGroupRequest $request
     * @return GroupResource
     */
    public function createGroup(CreateGroupRequest $request)
    {
        $group = TeacherGroup::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'discipline_id' => Discipline::where('second_id', $request->get('discipline_id'))->firstOrFail()->id,
            'teacher_id' => Auth::user()->id
        ]);

        return GroupResource::make($group);
    }

    /**
     * Удаление группы
     *
     * @param $groupId
     * @return GroupResource
     */
    public function deleteGroup($groupId)
    {
        $group = TeacherGroup::findOrFail($groupId);
        $group->delete();

        return GroupResource::make($group);
    }

    /**
     * получение групп
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getStudentGroups()
    {
        $currentUser = Auth::user();

        return GroupResource::collection($currentUser->getStudentGroups);
    }

    public function getStudentGroup($groupId)
    {
        $currentUser = Auth::user();

        return GroupResource::make($currentUser->getStudentGroups->where('id', $groupId)->firstOrFail());
    }
}
