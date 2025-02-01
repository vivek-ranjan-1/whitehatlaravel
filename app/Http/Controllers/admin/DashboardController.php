<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\admin\YoutubeVideo;
use App\Models\admin\Activity;
use App\Models\admin\Query;
use App\Models\admin\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){ 
        $title = 'Dashboard Page';
		$breadcrumbs = [
			'javascript:void(0);' => 'Dashboard'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
		$countData = [];
        $countData['Total Activities'] = Activity::count();
        $countData['Total Videos'] = YoutubeVideo::count();
        $countData['Total Queries'] = Query::count(); 
        $countData['Total Projects'] = Project::count(); 
		$color = ['bg-warning','bg-danger','bg-primary', 'bg-success'];
		$icons = ['fa fa-eye','fa-brands fa-youtube','fa-solid fa-message', 'fa-solid fa-building'];
		
        // dd($icons);
		
        return view('admin.dashboard',compact('title','breadcrumbHtml','countData','color','icons'));
    }
	 
	
	/*
	# @Author        : Mr. VIVEK RANJAN
	# @Email id      : 16cs086vive@gmail.com 
	# @Contact No    : 9400365935 / 9827029863
	# @Functionality : Listing the activities on this site
	# @App-version   : 1.0
    * @description user controller
	*/
	public function ajaxList(Request $request){
		
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

         // Total records
		 $totalRecords = Activity::select('count(*) as allcount','activities');
		 
         if(!empty($searchValue)){
            $totalRecords->where('activities.activity', 'like', '%' .$searchValue . '%');
            $totalRecords->orWhere('activities.ip_address', 'like', '%' .$searchValue . '%');
            $totalRecords->orWhere('activities.user_agent', 'like', '%' .$searchValue . '%');
         }
         
         $totalRecords = $totalRecords->count();

         $totalRecordswithFilter = Activity::select('count(*) as allcount','activities');
         if(!empty($searchValue)){
            $totalRecordswithFilter->where('activities.activity', 'like', '%' .$searchValue . '%');
            $totalRecordswithFilter->orWhere('activities.ip_address', 'like', '%' .$searchValue . '%');
            $totalRecordswithFilter->orWhere('activities.user_agent', 'like', '%' .$searchValue . '%');
         }
         
         $totalRecordswithFilter = $totalRecordswithFilter->count();
		
         // Fetch records
		$records = Activity::orderBy($columnName,$columnSortOrder);
		if(!empty($searchValue)){
		    $records->where('activities.activity', 'like', '%' .$searchValue . '%');
            $records->orWhere('activities.ip_address', 'like', '%' .$searchValue . '%');
            $records->orWhere('activities.user_agent', 'like', '%' .$searchValue . '%');
		}

		$records->select('activities.*');
		$records->skip($start);
		$records->take($rowperpage);
		$records = $records->get();
        
         $data_arr = array();
         $sno = $start+1;
         $i=1;
         foreach($records as $record){
			$activity   = $record->activity;
			$ip_address = $record->ip_address;
			$city       = $record->city;
			$user_agent = $record->user_agent;
			$createdDate = formatDate($record->created_at);
			$slno       = $i++;
			$action     = array();
			$id         = base64_encode($record->id);
			
			$data_arr[] = array(
			  "id" => $sno++,
			  "activity" => ucfirst($activity),             
			  "ip_address" => $ip_address,
			  "city"       => $city,
			  "created_at" => $createdDate,
			  "user_agent" => $user_agent,
			);
		 }

		 $response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordswithFilter,
			"aaData" => $data_arr
		 );

		 echo json_encode($response);
		 exit;
    }

    public function comingSoon(){
        return view('comingsoon');
    }

    public function loadVideo(Request $request){
        $videos = YoutubeVideo::paginate(3);
		$videos->map(function ($video) {
			$video->fomatedDate = formatDate($video->created_at);
			return $video;
		}); 
        return response()->json([
            'status' => true,
            'data'   => $videos,
            'message'=> 'Data loaded.'
        ],200);
    }
}