<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RelativesResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'profile_image' =>$this->getFirstMediaUrl('relatives') !=""?$this->getFirstMediaUrl('relatives') : asset('images/default-image.jpg'),
            'gender' => $this->gender,
            'identity_number' => $this->identity_number,
            'seat_number'=>$this->seat_number,
            'country'=>$this->country,
            'city'=>$this->city,
            "chronic_disease"=> $this->getRawOriginal('chronic_disease'),
            "chronic_disease_description"=> $this->chronic_disease_description,
        ];
    }
}
