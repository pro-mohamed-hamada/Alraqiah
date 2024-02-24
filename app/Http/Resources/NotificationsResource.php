<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
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
           'id'=>$this->id,
           'title'=>$this->title,
           'content'=>$this->body,
           'read_at'=>$this->read_at,
       ];
    }
}
