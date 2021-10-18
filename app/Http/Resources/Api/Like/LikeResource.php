<?php

namespace App\Http\Resources\Api\Like;

use App\Http\Resources\Api\Admin\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
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
            'type' => trans('like.types.' . $this->type),
            'user' => UserResource::make($this->user),
            'foreign' => UserResource::make($this->foreign),
            'value' => $this->value
        ];
    }
}
