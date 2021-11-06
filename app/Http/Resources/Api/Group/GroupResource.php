<?php

namespace App\Http\Resources\Api\Group;

use App\Http\Resources\Api\Discipline\DisciplineResource;
use App\Http\Resources\Api\Group\Discipline\GroupDisciplineResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'discipline' => GroupDisciplineResource::make($this->discipline),
            'students' => $this->students,
            'tasks' => $this->tasks,
            'created_at' => $this->created_at
        ];
    }
}
