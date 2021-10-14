<?php

namespace App\Http\Resources\Api\Like;

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
            'type' => trans('like.types.' . $this->type),
            'user' => $this->user,
            'foreign_id' => $this->foreign_id,
            'value' => $this->value
        ];
    }
}
