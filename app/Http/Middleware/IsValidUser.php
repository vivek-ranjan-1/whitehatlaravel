<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\admin\Module;
use App\Models\admin\Permission;

class IsValidUser{
	public function handle(Request $request, Closure $next){
		
		$roleId = Auth::user()?->role_id;
		$moduleNames = explode('/',url()->current());
		$moduleName = ($moduleNames[4] === 'frontend-pages') ? 'frontend-pages/'.$moduleNames[5] : $moduleNames[4];
		$moduleId = Module::where('url', $moduleName)?->first()?->id; 		
		$permissions = Permission::where([
			'module_id' => $moduleId,
			'role_id' => $roleId			
		])?->first()?->permissions;
		$allPermissions = json_decode($permissions, true);
		//dd($moduleName);
		if(empty($allPermissions)){
			return redirect()->route('dashboard')->with('error', 'You have no permission to access.');
		}
		return $next($request);
    }
}