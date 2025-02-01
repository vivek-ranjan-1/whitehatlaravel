<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Query;
use Illuminate\Support\Facades\Http;

class SendMailController extends Controller
{
    public function SendContactMail(Request $request){
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'mobile'=> 'required|numeric',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $mailData = $request->all();
		$created  = Query::create($mailData);
		if($created){
			Mail::to($request->email)->send(new ContactMail($mailData));
			$mailData['reciever'] = 'admin';
			//Mail::to('rohit.mis.360@gmail.com')->cc('360propguide@gmail.com')->send(new ContactMail($mailData));
		
			return response()->json(['message' => 'Thank You Message','status'=> true], 200);
		}else{
			return response()->json(['message' => 'Something Went wrong','status'=> false], 200);
		}
    }
}

