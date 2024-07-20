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
            "package"=>$this->package,
            "launch_date"=>$this->launch_date,
            "seat_number"=>$this->seat_number,
            "name"=>$this->user?->name,
            "phone"=>$this->user?->phone,
            'profile_image' =>$this->user->getFirstMediaUrl('users') !=""?$this->user->getFirstMediaUrl('users') : asset('images/default-image.jpg'),
            "gender"=>$this->gender,
            "identity_number"=>$this->identity_number,
            "lat"=>$this->user->lat,
            "lng"=>$this->user->lng,
            "country"=>$this->country,
            "city"=>$this->city,
            "relaives"=>$this->whenLoaded('relatives', RelativesResource::collection($this->relatives)),
            "sites"=>$this->whenLoaded('sites', SitesResource::collection($this->sites)),
            "supervisor"=> new UsersResource($this->supervisor),
            "chronic_disease"=> $this->getRawOriginal('chronic_disease'),
            "chronic_disease_description"=> $this->chronic_disease_description,
            "arrival_location_url"=> $this->arrival_location_url,
            "qrcode"=> $this->qrcode,
        ];
    }
}
