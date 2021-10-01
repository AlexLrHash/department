<?php

namespace App\Http\Resources\Api\Admin\User;

use App\Classes\Enum\UserRoleEnum;
use App\Http\Resources\Api\Admin\Discipline\DisciplineResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $commonNumberOfWork = $this->commonNumberOfWork();

        $commonNumberOfLabs = Arr::get($commonNumberOfWork, 'common_number_of_labs');
        $commonNumberOfPractices = Arr::get($commonNumberOfWork, 'common_number_of_practices');

        return [
            'id' => $this->second_id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => trans('roles.' . $this->role),
            'department' => $this->department,
            'disciplines' => TeacherDisciplineResource::collection($this->disciplines),
            'common_number_of_labs' => $commonNumberOfLabs,
            'common_number_of_practices' => $commonNumberOfPractices,
            'avatar' => $this->avatar
        ];
    }
}
