<?php

namespace App\Http\Controllers\Api\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Group\Task\GroupTaskRequest;
use App\Http\Resources\Api\Group\Task\GroupTaskResource;
use App\Jobs\SendEmailCreateTaskJob;
use App\Jobs\SendEmailRemoveStudentJob;
use App\Models\GroupTask;
use App\Models\TeacherGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupTaskController extends Controller
{
    /**
     * Добавление задачи
     *
     * @param GroupTaskRequest $request
     * @param $groupId
     * @return GroupTaskResource
     */
    public function addTask(GroupTaskRequest $request, $groupId)
    {
        $task = GroupTask::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'group_id' => $groupId,
            'expired_at' => Carbon::create($request->get('expired_at'))
        ]);

        $group = TeacherGroup::find($groupId);

        foreach ($group->students as $student) {
            $job = new SendEmailCreateTaskJob($student->email, $group->name, Auth::user()->name);
            $this->dispatch($job);
        }

        return GroupTaskResource::make($task);
    }

    /**
     * Удаление задачи
     *
     * @param Request $request
     * @param $groupId
     * @return GroupTaskResource
     */
    public function removeTask(Request $request, $groupId)
    {
        $task = GroupTask::where('id', $request->get("task_id"))->where('group_id', $groupId)->firstOrFail();
        $task->delete();

        return GroupTaskResource::make($task);
    }
}
