<?php

namespace App\Http\Resources\Api\Admin;

use App\Http\Resources\Api\Admin\User\UserResource;
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
            'manager' => UserResource::make($this->manager)
        ];
    }
}
