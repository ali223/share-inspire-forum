<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'topic_id' => $this->topic_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'likes_count' => $this->likes_count,
            'is_liked' => $this->is_liked,
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
