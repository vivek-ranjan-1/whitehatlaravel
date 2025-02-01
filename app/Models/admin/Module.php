<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait

class Module extends Model
{
    use HasFactory, SoftDeletes; // Use SoftDeletes trait for soft delete functionality

    // Define the table name (optional, if the table name follows Laravel's convention)
    protected $table = 'modules';

    // Define the fillable columns (mass assignable attributes)
    protected $fillable = [
        'name',
        'url',
        'short_description',
    ];

    // Optionally, define the date format for the timestamps
    protected $dates = ['deleted_at'];

    // You can add additional relationships, scopes, or methods if needed
}
