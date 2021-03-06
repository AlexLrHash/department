<?php

namespace App\Http\Resources\Api\Department;

use App\Http\Resources\Api\User\Teacher\TeacherResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->second_id,
            'name' => $this->name,
            'description' => $this->description,
            'background' => $this->background,
            'manager' => DepartmentManagerResource::make($this->manager),
            'teachers' => TeacherResource::collection($this->getTeachers())
        ];
    }
}
