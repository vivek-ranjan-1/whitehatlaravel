<?php

namespace App\Http\Controllers\admin\authorizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Permission;

class PermissionController extends Controller{
	
	public function	__construct(){	
	}
	
	public function add(){
		
		$title = 'Operations List';
		
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'settings.index' => 'Settings',
			'javascript:void(0);' => 'List'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
		return view('admin.authorizations.operation', compact('title','breadcrumbHtml'));
	}
					
	
	public function store(Request $request){
		if (!empty($request->permissions)) {
			$permissionsArray = [];
			foreach ($request->permissions as $permission) {
				preg_match('/permissions\[(.*?)\]\[(.*?)\]/', $permission, $matches);
				
				if ($matches) {
					$key = $matches[1]; 
					$action = $matches[2];
					if (!isset($permissionsArray[$key])) {
						$permissionsArray[$key] = [];
					}
					$permissionsArray[$key][] = $action; 
				}
			}
			if(!empty($permissionsArray) && count($permissionsArray) > 0){
				foreach($permissionsArray as $key => $list){
					$moduleId = base64_decode($key);
					$roleId = base64_decode($request->role_id);
					$store = Permission::updateOrCreate([
						'module_id' => $moduleId,
						'role_id' => $roleId
					],[
						'permissions' => json_encode($list)
					]);
				}
			}
		}
		
		return response()->json([
			'message' => 'Permissions updated successfully.',
			'status'  => true,
			'data'    => null
		]);
	}
}