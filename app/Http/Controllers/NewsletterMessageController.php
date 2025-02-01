<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterMessage;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Log;

class NewsletterMessageController extends Controller
{
    public function index(){
		$title = 'Newsletter';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'message.index' => 'Home Page',
			'javascript:void(0);' => 'View'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
		$message = NewsletterMessage::orderBy('id', 'DESC')->first();
		
		
		
	
        return view('admin.newsletter.list',compact('title','breadcrumbHtml', 'message'));  
	}
	
	//store
	public function store(Request $request)
    {
		//dd($request->all());
		$request->validate([
               'title' => 'required',
               'date' => 'required',
               'time' => 'required',
               'message' => 'required',
               'image' => 'required',
            ]);
        try{
			$message = new NewsletterMessage;
			$message->title = $request->title;
			$message->date = $request->date;
			$message->time = $request->time; 
			$message->message = $request->message;
			if($request->hasFile('image')){
				$image = uploadFile($request->file('image'),'newsletter');
				$message->image = $image;
			}

			if($message->save()){
				return redirect()->route('message.index')->with('success', 'Message uploaded successfully!');
			}else{
				return redirect()->route('message.index')->with('error', 'Message could not uploaded!');
			}	
		}catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
    }
	
}
