<?php

namespace App\Http\Resources\Api\Group\Task;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupTaskResource extends JsonResource
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
            'expired_at' => $this->expired_at
        ];
    }
}
