<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\ProjectLocation;
use App\Models\admin\ProjectHighlight;
use App\Models\admin\ProjectFloorPlan;
use App\Models\admin\ProjectPossession;
use App\Models\admin\ProjectAmenity;
use App\Models\admin\ProjectDevBackground;
use App\Models\admin\ProjectPricing;
use App\Models\admin\ProjectAdvice;
use App\Models\admin\ProjectFile;

class Project extends Model
{
    use HasFactory;
	
	public function locations(){
		return $this->hasOne(ProjectLocation::class);
    }
	
	public function highlights(){
		return $this->hasOne(ProjectHighlight::class);
    }
	
	public function floorPlans(){
		return $this->hasOne(ProjectFloorPlan::class);
    }
	
	public function possessions(){
		return $this->hasOne(ProjectPossession::class);
    }
	
	public function amenities(){
		return $this->hasOne(ProjectAmenity::class);
    }
	
	public function devBackgrounds(){
		return $this->hasOne(ProjectDevBackground::class);
    }
	
	public function pricings(){
		return $this->hasOne(ProjectPricing::class);
    }
	
	public function advices(){
		return $this->hasOne(ProjectAdvice::class);
    }
	
	public function files(){
		return $this->hasOne(ProjectFile::class);
    }
	
}
