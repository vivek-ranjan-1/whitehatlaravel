<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
    * AuthController Class
    *
    * @Author- Mr. Vivek Ranjan
    * @Contact No.- 9827029863 / 9400365935
    * @email- 16cs086vive@gmail.com
    * @App-version 1.0
    * @description user controller
    *
    * @Functions- Login System for the admin panel
    */
    
    public function loginView(){
        $title = 'Login Admin';
        return view('admin.auth.login',['title' => $title]);
    }

    public function login(Request $request){

        $request->validate([
            'username' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->username,
            'password' => $request->password
        ];
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
			create_log('Admin Panel Logged in.');
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }
		
        return back()->withErrors([
            'credentials' => 'Your provided credentials do not match in our records.',
        ]);

    }
	
	//edit profile
	public function editProfile(){
		$title = 'Update Password';
		$breadcrumbs =[
		      'dashboard' => 'Dashboard',
			  'user-profile' => 'Profile',
			  'javascript:void(0);' => 'Update'
		];
        $breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
        return view('admin.auth.edit-profile', compact('title','breadcrumbHtml'));
	}
     public function updatePassword(Request $request){
		$request->validate([
			'oldPassword' 	  => 'required',
			'newPassword' 	  => 'required|min:8',
			'confirmPassword' => 'required|min:8',
		]);
		$admin = Auth::user();

		if (!Hash::check($request->oldPassword, $admin->password)) {
			return back()->withErrors(['oldPassword' => 'Current password is incorrect']);
		}

		$admin->password = Hash::make($request->newPassword);
		$admin->save();
		// Log out from all devices
		Auth::logoutOtherDevices($request->newPassword);

		Auth::logout();
		return redirect()->route('login');
	}

    //logout
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}