<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShortLinkResource extends JsonResource
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
            'name' => $this->name ?? '',
            'slug' => $this->slug ?? '',
            'url' => $this->target_url ?? '',
            'expired_date' => $this->expired_at ?? '',
        ];
    }
}
