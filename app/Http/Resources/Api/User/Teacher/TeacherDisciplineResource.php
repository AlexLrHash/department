<?php

namespace App\Http\Resources\Api\User\Teacher;

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
            'description' => $this->descriptions,
            'number_of_labs' => $this->number_of_labs,
            'number_of_practices' => $this->number_of_practices,
        ];
    }
}
