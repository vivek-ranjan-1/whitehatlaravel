<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\admin\Module;

class BlogsController extends Controller
{
    public function index(){
		$title = 'Blogs Page';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'blogs.index' => 'Blogs Page', 
			'javascript:void(0);' => 'View'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
        return view('admin.frontend.blogs.list',compact('title','breadcrumbHtml'));
	}
	
	public function ajaxList(Request $request){
		$remove = '';
		$moduleId = Module::where('url', 'frontend-pages/blogs')->first()?->id;
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
		$totalRecords = Blog::select('count(*) as allcount','blogs');
		 
		if(!empty($searchValue)){
			$totalRecords->where('blogs.title', 'like', '%' .$searchValue . '%');
			$totalRecords->orWhere('blogs.slug', 'like', '%' .$searchValue . '%');
			$totalRecords->orWhere('blogs.created_at', 'like', '%' .$searchValue . '%');
		}
		if(Auth::user()->role_id === 3){
			$totalRecords->where('status', false);
		}
         
        $totalRecords = $totalRecords->count();

		$totalRecordswithFilter = Blog::select('count(*) as allcount','blogs');
		if(!empty($searchValue)){  
			$totalRecordswithFilter->where('blogs.title', 'like', '%' .$searchValue . '%');
			$totalRecordswithFilter->orWhere('blogs.slug', 'like', '%' .$searchValue . '%');
			$totalRecordswithFilter->orWhere('blogs.created_at', 'like', '%' .$searchValue . '%');
		}
         if(Auth::user()->role_id === 3){
			$totalRecordswithFilter->where('status', false);
		}
        $totalRecordswithFilter = $totalRecordswithFilter->count();

        // Fetch records
		$records = Blog::orderBy('blogs.created_at', 'desc');
		$records->orderBy($columnName,$columnSortOrder);
		
		if(!empty($searchValue)){
		    $records->where('blogs.title', 'like', '%' .$searchValue . '%');
            $records->orWhere('blogs.slug', 'like', '%' .$searchValue . '%');
            $records->orWhere('blogs.created_at', 'like', '%' .$searchValue . '%');
		}

		$records->select('blogs.*');
		$records->skip($start);
		$records->take($rowperpage);
		if(Auth::user()->role_id === 3){
			$records->where('status', false);
		}
		$records = $records->get();
        
        $data_arr = array();
        $sno = $start+1;
        $i=1;
        foreach($records as $record){
			$title = $record->title;
			$featured_image = '<img src="/storage/'.$record->featured_image.'" style="height:150px">';
			$slug = '<iframe style="height:150px" class="iframe" src="'.$record->slug.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>';
			$description = $record->description; 
			$slno = $i++;
			$action = array();
			$id = base64_encode($record->id);
			$deleteConfirm = 'return myConfirm("frontend-pages/blogs/delete/'.$id.'")';
			$trendingConfirm = 'return myConfirm("blogs/trending/'.$id.'")';
			$statusConfirm = 'return myConfirm("frontend-pages/blogs/status/'.$id.'")';
			
			$edit="<a href='blogs/edit/".base64_encode($record->id)."' class='notPrintable btn btn-xs btn-info'><i class='fas fa-pen'></i></a>";
			
			if(userPermissions('delete', $moduleId)){
				$remove = "<a href='javascript: void(0)' class='notPrintable btn btn-xs btn-danger' onclick='$deleteConfirm'><i class='fas fa-times'></i></a>";
			}
			
			
			$statusBtn = $record->status == 1 ? 'btn-info':'alert alert-info mb-0'; 
            $statusText = $record->status == 1 ? ' Active ' : ' Inactive '; 
			
			$status = "<a href='javascript: void(0)' class='notPrintable btn btn-xs {$statusBtn}'  style='padding:0.5rem' onclick='$statusConfirm'>{$statusText}</a>";
					   
			$action[] = $edit." ".$remove;
			$data_arr[] = array(
			  "id" => $sno++,
			  "title" => ucfirst($title),             
			  "featured_image" => $featured_image,
			  "slug" => $slug,
			  'status' => $status, 
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
    }
	
	public function add(){
		try{
			$title = 'Add New Blog';
			$breadcrumbs = [
				'dashboard' => 'Dashboard',
				'blogs.index' => 'Blogs Page', 
				'javascript:void(0);' => 'Add New'
			];
			$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
			return view('admin.frontend.blogs.add',compact('title','breadcrumbHtml'));
		}catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}
	
	public function store1(Request $request){
		try{
			$request->validate([ 
				'title' => 'required|string',
				'short_description' => 'required|string',
				'seo_data' => 'required',
				'description' => 'required',
				'featured_image' => 'required'
			]);
			
			$description = $request->input('description');
			
			$description = $this->processBase64Images($description); 
			$blog = new Blog;
			$blog->user_id = Auth::user()->id;
			$blog->title = $request->title;
			$blog->short_description = $request->short_description;
			$blog->slug = $request->slug; 
			$blog->seo_data = json_encode($request->seo_data);
			$blog->description = $description;
			if($request->hasFile('featured_image')){
				$featuredImage = uploadFile($request->file('featured_image'),'blogs');
				$blog->featured_image = $featuredImage;
			}
			$blog->status = isset($request->status) ? true : false;
			
			if($blog->save()){
				return redirect()->route('blogs.index')->with('success', 'Blogs uploaded successfully!');
			}else{
				return redirect()->route('blogs.index')->with('error', 'Blogs could not uploaded!');
			}	
		}catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}
	
	private function processBase64Images($content)
{
	$content = preg_replace('/\s*(data-filename|style)=[^"\']*["\']/', '', $content);
	$pattern = '/<img\s+src=["\']data:image\/([^;]+);base64,([^"\']*)["\']/i';
    preg_match_all($pattern, $content, $matches);
 //dd($matches);
    foreach ($matches[0] as $index => $base64Image) {
        // Extract the MIME type and base64 string
        $mimeType = $matches[1][$index]; // e.g., 'png', 'jpeg', etc.
        $base64String = $matches[2][$index];

        // Decode the base64 string
        $imageData = base64_decode($base64String);
        if (!$imageData) {
            continue; // Skip invalid base64 strings
        }

        // Generate a unique file name with the correct extension
        $extension = $mimeType === 'jpeg' ? 'jpg' : $mimeType;
        $fileName = 'img_' . Str::random(10) . '.' . $extension;
        $path = 'public/blogs/' . $fileName;

        // Save the image
        Storage::put($path, $imageData);
        $fileUrl = Storage::url($path);

        // Replace the base64 image with the URL
        $content = str_replace($base64Image, '<img style="width:100%" src="' . $fileUrl . '">', $content);
    }
    //dd($content); 
    return $content;
}
	
	
	public function edit($id){
		try{
			$title = 'Update Blog Details';
			$breadcrumbs = [
				'dashboard' => 'Dashboard',
				'blogs.index' => 'Blogs Page', 
				'javascript:void(0);' => 'Edit Blog'
			];
			$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
			
			$blog = Blog::findOrFail(base64_decode($id));
			$blog->seo_data = json_decode($blog->seo_data,true);
			return view('admin.frontend.blogs.edit',compact('title','blog','breadcrumbHtml'));
		}catch (ModelNotFoundException $e) {
			Log::error('Model not found: ' . $e->getMessage());
			return response()->json([
				'message' => 'Model not found.',
				'status' => false
			], 404);
		}catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}
	
	public function update1(Request $request){
		try{
			$blog = Blog::findOrFail(base64_decode($request->id));
			$blog->user_id = Auth::user()->id;
			$blog->title = $request->title;
			$blog->short_description = $request->short_description;
			$blog->slug = $request->slug; 
			$blog->seo_data = json_encode($request->seo_data);
			$description = $request->input('description');
			$description = $this->processBase64Images($description); 
			$blog->description = $description;
			if($request->hasFile('featured_image')){
				$featuredImage = uploadFile($request->file('featured_image'),'blogs');
				$blog->featured_image = $featuredImage;
			}
			$blog->status = isset($request->status) ? true : false;
			
			if($blog->save()){
				return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
			}else{
				return redirect()->route('blogs.index')->with('error', 'Blog could not updated.!');
			}
		}catch (ModelNotFoundException $e) {
			Log::error('Model not found: ' . $e->getMessage());
			return response()->json([
				'message' => 'Model not found.',
				'status' => false
			], 404);
		}catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error'.$e->getMessage(),
				'status' => false
			], 500);
		}
	}
	
	public function moveToBin($id){
		try{
			$blog = Blog::findOrFail(base64_decode($id));
			if($blog->delete()){
				//Log::error('Model not found: ' . $e->getMessage());	
				return response()->json([
					'message' => 'Blog deleted successfully.',
					'status' => true
				], 200);
			}
		}catch (ModelNotFoundException $e) {
			Log::error('Model not found: ' . $e->getMessage());
			return response()->json([
				'message' => 'Model not found.',
				'status' => false
			], 404);
		}catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}
	
	public function permanentRemove($id){
		try{
			$blog = Blog::findOrFail(base64_decode($id));
			if($blog->forceDelete()){
				//Log::error('Model not found: ' . $e->getMessage());	
				return response()->json([
					'message' => 'Blog deleted successfully.',
					'status' => true
				], 200);
			}
		}catch (ModelNotFoundException $e) {
			Log::error('Model not found: ' . $e->getMessage());
			return response()->json([
				'message' => 'Model not found.',
				'status' => false
			], 404);
		}catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}
	
	public function changeStatus($id){
		try{
			$id = base64_decode($id);
			$blog = Blog::findOrFail($id);
			$blog->status = (!$blog->status);
			$blog->save();
			return response()->json([
				"message" => "Status changed successfully",
				"status" => true
			]);
		}catch(\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return back()->withInput()->withErrors(['error' => 'Something went wrong.']);
		}
	}
	
	
	
	public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/blogs/');
            return response()->json(asset('storage/' . substr($path, 7)));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'slug' => 'required',
			'short_description' => 'required|string',
			'seo_data' => 'required',
			'featured_image' => 'required'
        ]);
		
		$blog = new Blog;
		$blog->title = $request->title;
		$blog->user_id = Auth::user()->id;
		$blog->short_description = $request->short_description;
		$blog->seo_data = json_encode($request->seo_data);
		$blog->slug = $request->slug;
		$blog->description = $request->description;
		$blog->status = isset($request->status) ? true : false;
		if($request->hasFile('featured_image')){
			$blog->featured_image = uploadFile($request->file('featured_image'),'blogs');
		}
		$blog->save();
		
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function update(Request $request)
    {
		// dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
			'short_description' => 'required|string',
			'seo_data' => 'required',
        ]);

        
		$blog = Blog::findOrFail(base64_decode($request->id));
		$blog->title = $request->title;
		$blog->user_id = Auth::user()->id;
		$blog->slug = $request->slug;
		$blog->short_description = $request->short_description;
		$blog->seo_data = json_encode($request->seo_data); 
		$blog->description = $request->description;
		$blog->status = isset($request->status) ? true : false;
		if($request->hasFile('featured_image')){
			$blog->featured_image = uploadFile($request->file('featured_image'),'blogs');
		}
		$blog->save();
		

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!'); 
    }
}
