<?php

namespace App\Http\Controllers\admin\authorizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Module;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller{
	
	public function	__construct(){	
	}
	
	public function add(){
		
		$title = 'Modules List';
		
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'settings.index' => 'Settings',
			'javascript:void(0);' => 'List'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
		return view('admin.authorizations.module', compact('title','breadcrumbHtml'));
	}
	
	public function store(Request $request){
		try{
			$request->validate([ 
				'name' => 'required|string',
				'url' => 'required',
				'short_description' => 'required|string'
			]);
			
			$obj = new Module;
			$obj->name = $request->name;
			$obj->url = $request->url;
			$obj->short_description = $request->short_description;
			
			if($obj->save()){
				return response()->json([
					'message' => 'Module has been added successfully.',
					'status'  => true,
					'data'    => 'success'
				]);
			}else{
				return response()->json([
					'message' => 'Module could not be added.',
					'status'  => false,
					'data'    => 'error'
				]);
			}
		}catch(\Exception $e){
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error'.$e,
				'status' => false,
			], 500);
		}
	}
}