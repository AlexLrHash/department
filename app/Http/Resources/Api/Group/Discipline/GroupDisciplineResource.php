<?php

namespace App\Http\Resources\Api\Group\Discipline;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupDisciplineResource extends JsonResource
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
        ];
    }
}
