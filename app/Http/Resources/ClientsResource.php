<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "reservation_number"=>$this->reservation_number,
            "reservation_status"=>$this->reservation_status,
            "package"=>$this->package,
            "launch_date"=>$this->launch_date,
            "seat_number"=>$this->seat_number,
            "name"=>$this->user?->name,
            "phone"=>$this->user?->phone,
            "profile_image"=>$this->whenLoaded('defaultLogo', $this->DefaultLogo, asset('images/default-image.jpg')),
            "gender"=>$this->gender,
            "national_number"=>$this->national_number,
            "city"=>$this->city,
            "relaives"=>$this->whenLoaded('relatives', RelativesResource::collection($this->relatives)),
            "supervisor"=> new UsersResource($this->supervisor),
        ];
    }
}
