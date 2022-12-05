<?php

namespace Ogilo\Partners\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'logo' => $this->logo,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
            'published' => $this->published,
            'socialmedia' => json_decode($this->socialmedia),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
