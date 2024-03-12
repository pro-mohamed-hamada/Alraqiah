<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            "id"=> $this->id,
            "name"=> $this->name,
            "email"=> $this->email,
            "phone"=>$this->phone,
            "gender"=>$this->client?->gender,
            "user_type"=>$this->type,
            'profile_image' =>$this->getFirstMediaUrl('users') !=""?$this->getFirstMediaUrl('users') : asset('images/default-image.jpg'),
        ];
    }
}
