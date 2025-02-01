<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller
{
    public function up(Request $request)
    {
        // You may want to add some authentication/authorization logic here
        
        // Run the 'up' command to bring the site out of maintenance mode
        Artisan::call('up');
        
        return response()->json(['message' => 'Site is now out of maintenance mode'], 200);
    }
}
