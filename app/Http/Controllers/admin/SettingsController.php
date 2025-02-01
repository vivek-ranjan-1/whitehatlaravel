<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\Organization;
use \Illuminate\Support\Facades\Artisan;
use App\Models\Credential;
use App\Models\admin\Module;
use App\Models\admin\Role;
use App\Models\admin\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Settings';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'settings.index' => 'Settings',
			'javascript:void(0);' => 'View'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
		
		$organization = Organization::first();
		$credentials = Credential::orderBy('id', 'DESC')->first();
		
		$modules = Module::orderBy('id','DESC')->get();
		$roles = Role::orderBy('id','DESC')->get();
		$permissions = Permission::orderBy('id','DESC')->get();
		
        return view('admin.settings.view',compact('title','breadcrumbHtml','organization','credentials','modules','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		$title = 'Add New Youtube Videos';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'youtube-videos.index' => 'Youtube Videos',
			'javascript:void(0);' => 'Create'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
        return view('admin.youtube-videos.add',compact('title','breadcrumbHtml'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'video_source' => 'required',
            'thumbnail' => 'required|image',
            'title' => 'required',
            'description' => 'nullable'
        ]);
    
        // Store the thumbnail
        $thumbnailPath = uploadFile($request->file('thumbnail'),'thumbnails');
    
        // Now, you can save other data to the database, including the path to the thumbnail
        $video = new YouTubeVideo();
        $video->video_source = $request->video_source;
        $video->title = $request->title;
        $video->description = $request->description;
        $video->thumbnail = $thumbnailPath; // Save the path to the thumbnail
        $video->status = true;
        $video->save();
    
        return redirect()->route('youtube-videos.index')->with('success', 'Video uploaded successfully!');

    }
    
	
	public function storeUser(Request $request){
		
		 $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'role_id' => 'required'
        ]);
    
        $userObj = new User;
		$userObj->name = $request->name;
		$userObj->email = $request->email;
		$userObj->password = Hash::make($request->input('password'));
		$userObj->role_id = $request->role_id;
        $userObj->save();
    
        return redirect()->route('settings.index')->with('success', 'User Added successfully!');
	}
    
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
        
         
		 $totalRecords = YouTubeVideo::select('count(*) as allcount','youtube_videos');
		 
         if(!empty($searchValue)){
            $totalRecords->where('youtube_videos.title', 'like', '%' .$searchValue . '%');
            $totalRecords->orWhere('youtube_videos.video_source', 'like', '%' .$searchValue . '%');
            $totalRecords->orWhere('youtube_videos.created_at', 'like', '%' .$searchValue . '%');
         }
         
         $totalRecords = $totalRecords->count();

         $totalRecordswithFilter = YouTubeVideo::select('count(*) as allcount','youtube_videos');
         if(!empty($searchValue)){
             
            $totalRecordswithFilter->where('youtube_videos.title', 'like', '%' .$searchValue . '%');
            $totalRecordswithFilter->orWhere('youtube_videos.video_source', 'like', '%' .$searchValue . '%');
            $totalRecordswithFilter->orWhere('youtube_videos.created_at', 'like', '%' .$searchValue . '%');
         }
         
         $totalRecordswithFilter = $totalRecordswithFilter->count();

         // Fetch records
		$records = YouTubeVideo::orderBy($columnName,$columnSortOrder);
		if(!empty($searchValue)){
		    $records->where('youtube_videos.title', 'like', '%' .$searchValue . '%');
            $records->orWhere('youtube_videos.video_source', 'like', '%' .$searchValue . '%');
            $records->orWhere('youtube_videos.created_at', 'like', '%' .$searchValue . '%');
		}

		$records->select('youtube_videos.*');
		$records->skip($start);
		$records->take($rowperpage);
		$records = $records->get();
        
         $data_arr = array();
         $sno = $start+1;
         $i=1;
         foreach($records as $record){
                $title = $record->title;
                $thumbnail = '<img src="/storage/'.$record->thumbnail.'" style="height:150px">';
                $video_source = '<iframe style="height:150px" class="iframe" src="'.$record->video_source.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>';
                $description = $record->description; 
                $slno = $i++;
                $action = array();
                $id = base64_encode($record->id);
                $deleteConfirm = 'return myConfirm("youtube-videos/delete/'.$id.'")';
                $trendingConfirm = 'return myConfirm("youtube-videos/trending/'.$id.'")';
                $statusConfirm = 'return myConfirm("youtube-videos/status/'.$id.'")';
                
                $edit="<a href='youtube-videos/edit/".base64_encode($record->id)."' class='notPrintable btn btn-xs btn-info'><i class='fas fa-pen'></i></a>";
                
                
                $remove = "<a href='javascript: void(0)' class='notPrintable btn btn-xs btn-danger' onclick='$deleteConfirm'><i class='fas fa-times'></i></a>";
                
                $trendingBtn = $record->trending == 1 ? 'btn-info':'alert alert-info mb-0';
                $trendingText = $record->trending == 1 ? 'Trending' : 'Trending';
                $trending = "<a href='javascript: void(0)' class='notPrintable btn btn-xs {$trendingBtn}' style='padding:0.5rem' onclick='$trendingConfirm'>$trendingText</a>";
                
                $statusBtn = $record->status == 1 ? 'btn-info':'alert alert-info mb-0';
                $statusText = $record->status == 1 ? ' Active ' : ' Active ';
                
                $status = "<a href='javascript: void(0)' class='notPrintable btn btn-xs {$statusBtn}'  style='padding:0.5rem' onclick='$statusConfirm'>{$statusText}</a>";
                           
                $action[] = $edit." ".$remove;
                $data_arr[] = array(
                  "id" => $sno++,
                  "title" => ucfirst($title),             
                  "thumbnail" => $thumbnail,
                  "video_source" => $video_source,
                  'status' => $status." ".$trending,
                  'action' => $action
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
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = YouTubeVideo::find(base64_decode($id));

		$title = 'Edit Youtube Videos';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'youtube-videos.index' => 'Youtube Videos',
			'javascript:void(0);' => 'Edit'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
        return view('admin.youtube-videos.edit',compact('title','breadcrumbHtml','video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'video_source' => 'nullable',
            'thumbnail'    => 'nullable|image',
            'title'        => 'nullable',
            'description'  => 'nullable'
        ]);
    
        $video = YouTubeVideo::find(base64_decode($request->id));
        if(isset($request->thumbnail)){
            $oldPath = $video->thumbnail;
			
			removeFile($oldPath);
			$thumbnailPath = uploadFile($request->file('thumbnail'),'thumbnails');
            $video->thumbnail = $thumbnailPath;
        }
        $video->video_source = $request->video_source;
        $video->title = $request->title;
        $video->description = $request->description;
        $video->status = true;
        $video->save();
    
        return redirect()->route('youtube-videos.index')->with('success', 'Video updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {
        $video = YouTubeVideo::find(base64_decode($id));
        $video->delete();
        return response()->json([
            'message' => 'Video deleted successfully!',
            'status'  => true,
            'data'    => NULL
        ],200);
    }
	
    public function changeMode()
    {
        $organization = Organization::first();
		$organization->repair_mode = ($organization->repair_mode == 0) ? 1 : 0;
		$organization->save();
		($organization->repair_mode == 1) ? (Artisan::call('down')) : (Artisan::call('up'));
        return response()->json([
            'message' => 'Site mode has been changed successfully!',
            'status'  => true,
            'data'    => $organization
        ],200);
    }
	
	
	
      
}
