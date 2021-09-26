<?php

namespace App\Http\Resources\Api\Admin\User;

use App\Classes\Enum\UserRoleEnum;
use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->second_id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => trans('roles.' . $this->role),
            'department' => $this->department,
            'disciplines' => $this->disciplines,
            'avatar' => $this->avatar
        ];
    }
}
