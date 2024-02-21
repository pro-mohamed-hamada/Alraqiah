<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'complaint' => $this->complaint,
            'is_active' => $this->is_active,
            'replays' => $this->whenLoaded('replies', ComplaintRepliesResource::collection($this->Replies), null),
        ];
    }
}
