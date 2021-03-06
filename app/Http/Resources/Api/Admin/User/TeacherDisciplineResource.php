<?php

namespace App\Http\Resources\Api\Admin\User;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherDisciplineResource extends JsonResource
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
            'number_of_labs' => $this->whenPivotLoaded('teacher_discipline', function () {
                return $this->pivot->number_of_labs;
            }),
            'number_of_practices' => $this->whenPivotLoaded('teacher_discipline', function () {
                return $this->pivot->number_of_practices;
            }),
            'description' => $this->description,
        ];
    }
}
