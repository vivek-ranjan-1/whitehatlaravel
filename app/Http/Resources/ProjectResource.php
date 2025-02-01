<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
		// dd($this);
        return [
            'id' => $this->id,
            'featured_image' => url('storage/' . $this->featured_image),
            'logo_image' => url('storage/' . $this->logo),
            'name' => $this->name,
            'title' => $this->title,
            'owner_name' => $this->owner_name,
            'location' => $this->location ,
            'min_price' => $this->min_price ,
            'owner_name' => $this->owner_name,
            'bhk_plans' => $this->bhk_types,
			'no_of_apartments' => $this->highlights->no_of_apartments,
			'towers' => $this->highlights->towers,
            'land_area' => $this->land_area,
            'rera_no' => $this->rera_no, 
            'max_price' => $this->max_price,
			'launch_date' => $this->launch_date,
			'possession_rera_date' => $this->possession_rera_date,
			'city' => $this->city,
            'slug' => $this->slug,
			'bsp_super_area' => $this->bsp_super_area,
			'no_of_visits' => $this->no_of_visits,
			'faqs_data' => json_decode($this->faqs_data, true),
			'delivery_status' =>  deliveryStatus($this->delivery_status),
			'status' =>  (boolean)$this->status,
        ];
    }
}
