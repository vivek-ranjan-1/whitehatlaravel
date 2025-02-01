<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeroSection extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
	protected $guarded = ['_token'];
}
