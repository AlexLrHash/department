<?php

namespace App\Http\Resources\Api\User\Teacher;

use App\Http\Resources\Api\Discipline\DisciplineResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'email' => $this->email,
            'avatar' => $this->avatar,
            'disciplines' => TeacherDisciplineResource::collection($this->disciplines)
        ];
    }
}
