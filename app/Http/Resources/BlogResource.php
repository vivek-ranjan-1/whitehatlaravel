<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'seoData' => json_decode($this->seo_data, true),
            'title' => $this->title,
            'short_description' => $this->short_description,
			'description' => $this->description,
			'featured_image' => url('storage/' . $this->featured_image),
			'slug' => $this->slug,
			'created_at' => formatDate($this->created_at),
        ];
    }
}
