<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class NewsletterSubscriber extends Model
{
	 use Notifiable;
    use HasFactory;
	use SoftDeletes;
    protected $dates = ['deleted_at']; 
    protected $table = 'newsletter_subscribers';
    public $fillable = ['email'];	
}
