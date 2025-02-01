<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompareListingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
			'name' => $this->name,
            'logo_image' => url('storage/' . $this->logo),
            'min_price' => $this->min_price,
			'location' => $this->location,
            'slug' => $this->slug,
            'owner_name' => $this->owner_name,
			'delivery_status' =>  deliveryStatus($this->delivery_status),
        ];
    }
}
