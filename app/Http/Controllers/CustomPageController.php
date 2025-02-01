<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomPageController extends Controller
{
  function __construct() { 
  }
  
  /**
  
  
  **/
  public function store(Request $request){
	  try{
			$request->validate([
				
			]);
		}catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
  }
}
