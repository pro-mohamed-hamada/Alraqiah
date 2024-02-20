<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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
            'company_name'=>$this->company_name, 
            'primary_phone'=>$this->primary_phone,
            'email'=>$this->email,
            'whatsapp_phone'=>$this->whatsapp_phone,
            'about_us'=>$this->about_us,
            'terms_and_conditions'=>$this->terms_and_condtions,
            'rate'=>$this->rate,
        ];
    }
}
