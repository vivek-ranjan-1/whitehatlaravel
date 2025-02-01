<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Query;
use Mail;
use App\Mail\ReplyMail;
use Illuminate\Support\Facades\Validator;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {
        $title = 'Query List';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'queries.index' => 'Queries',
			'javascript:void(0);' => 'List'
		];

		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
        return view('admin.queries.list',compact('title','breadcrumbHtml'));
    }



	public function ajaxList(Request $request){
		header('Content-Type: application/json; charset=utf-8');
		$draw = $request->get('draw');
		$start = $request->get("start");
		$rowperpage = $request->get("length"); // Rows display per page

		$columnIndex_arr = $request->get('order');
		$columnName_arr = $request->get('columns');
		$order_arr = $request->get('order');
		$search_arr = $request->get('search');

		$columnIndex = $columnIndex_arr[0]['column']; // Column index
		$columnName = $columnName_arr[$columnIndex]['data']; // Column name
		$columnSortOrder = $order_arr[0]['dir']; // asc or desc

		$searchValue = $search_arr['value']; // Search value

		$totalRecords = Query::select('count(*) as allcount','queries');
		 
        if(!empty($searchValue)){
           $totalRecords->where('queries.name', 'like', '%' .$searchValue . '%');
           $totalRecords->orWhere('queries.email', 'like', '%' .$searchValue . '%');
           $totalRecords->orWhere('queries.mobile', 'like', '%' .$searchValue . '%');
           $totalRecords->orWhere('queries.message', 'like', '%' .$searchValue . '%');
           $totalRecords->orWhere('queries.created_at', 'like', '%' .$searchValue . '%');
        }
         
        $totalRecords = $totalRecords->count();
        $totalRecordswithFilter = Query::select('count(*) as allcount','queries');
        if(!empty($searchValue)){
           $totalRecordswithFilter->where('queries.name', 'like', '%' .$searchValue . '%');
           $totalRecordswithFilter->orWhere('queries.email', 'like', '%' .$searchValue . '%');
           $totalRecordswithFilter->orWhere('queries.mobile', 'like', '%' .$searchValue . '%');
           $totalRecordswithFilter->orWhere('queries.message', 'like', '%' .$searchValue . '%');
           $totalRecordswithFilter->orWhere('queries.created_at', 'like', '%' .$searchValue . '%');
        }
        
        $totalRecordswithFilter = $totalRecordswithFilter->count();

         // Fetch records
		$records = Query::orderBy($columnName,$columnSortOrder);

		if(!empty($searchValue)){
		   $records->where('queries.name', 'like', '%' .$searchValue . '%');
           $records->orWhere('queries.email', 'like', '%' .$searchValue . '%');
           $records->orWhere('queries.mobile', 'like', '%' .$searchValue . '%');
           $records->orWhere('queries.message', 'like', '%' .$searchValue . '%');
           $records->orWhere('queries.created_at', 'like', '%' .$searchValue . '%');
		}

		$records->select('queries.*');
		$records->skip($start);
		$records->take($rowperpage);
		$records = $records->get();
        
        $data_arr = array();
        $sno = $start+1;
        $i=1;
        foreach($records as $record){
			
			$name = $record->name;
			$mobile = $record->mobile;
			$email = $record->email;
			$message = substr($record->message,0,50);
			$reply = ($record->reply == NULL ) ? '<a href="queries/view/'.base64_encode($record->id).'" class="btn btn-info">View <i class="fa fa-eye"><i></button>' : '<button class="btn btn-success">Replied</button>' ;
			$slno = $i++;
			$action = array();
			$id = base64_encode($record->id);
			
			$data_arr[] = array(
				"id" => $sno++,
				"name" => ucfirst($name),             
				"email" => $email,
				"mobile" => $mobile,
				"message" =>clean($message),
				"reply" => $reply
			);
		}
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordswithFilter,
			"aaData" => $data_arr
		);
		
		echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
	
	public function reply(Request $request)
    {
        $request->validate([
			'id'    => 'required',
            'name'  => 'required|string|max:255',
            'mobile'=> 'required|numeric',
            'email' => 'required|email',
			'reply' => 'required'
        ]);

        
        $mailData = $request->all();
		$query  = Query::find(base64_decode($request->id));
		$query->reply = $request->reply;
		$replied = $query->save();
		
		$mailData['quotedMail'] = "On {$query->date}, {$query->email} wrote:\n";
		$mailData['quotedMail'] .= "> {$query->message}\n\n";
		
		$mailData['message']  .= "{$mailData['quotedMail']}Dear {$query->name},\n\n";
		$mailData['message']  .= "Thank you for your email. Here is my response:\n\n";
		$mailData['message']  .= "Best regards,\nWhite Hat Realty";
		
		if($replied){
			Mail::to($request->email)->send(new ReplyMail($mailData));
			return redirect()->route('queries.index')->with('success', 'Query has been replied successfully!');
		}else{
			return redirect()->route('queries.index')->with('error', 'Something Went Wrong!');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
		$title = 'Query From User';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'queries.index' => 'Queries',
			'javascript:void(0);' => 'view'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
        $query = Query::findOrFail(base64_decode($id));
		return view('admin.queries.view',compact('query','title','breadcrumbHtml'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
