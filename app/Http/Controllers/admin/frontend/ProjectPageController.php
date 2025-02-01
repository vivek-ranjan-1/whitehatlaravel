<?php

/**
* ProjectPageController Class
*
* @Author- Mr. Vivek Ranjan
* @Contact No.- 9827029863 / 9400365935
* @email- 16cs086vive@gmail.com
* @App-version 1.0
* @description project page controller
*
* @Functions- TO handle the functionality of frontend side
*/

namespace App\Http\Controllers\admin\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\admin\Project;
use App\Models\admin\ProjectLocation;
use App\Models\admin\ProjectHighlight;
use App\Models\admin\ProjectFloorPlan;
use App\Models\admin\ProjectPossession;
use App\Models\admin\ProjectAmenity;
use App\Models\admin\ProjectDevBackground;
use App\Models\admin\ProjectPricing;
use App\Models\admin\ProjectAdvice;
use App\Models\admin\ProjectFile;
use App\Models\admin\Module;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProjectPageController extends Controller{
	public function index(){
		$title = 'Projects Page';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'projects.index' => 'Projects Page', 
			'javascript:void(0);' => 'View'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
        return view('admin.frontend.projects.list',compact('title','breadcrumbHtml'));
	}
	
	public function ajaxList(Request $request){
		$remove = '';
		$moduleId = Module::where('url', 'frontend-pages/projects')->first()?->id;
		
         $draw = $request->get('draw'); // draw the request
         $start = $request->get("start"); // initialialization
         $rowperpage = $request->get("length"); // Rows display per page

         $columnIndex_arr = $request->get('order'); // get the orders from the column request
         $columnName_arr = $request->get('columns'); // get the columns 
         $order_arr = $request->get('order');
         $search_arr = $request->get('search');

         $columnIndex = $columnIndex_arr[0]['column']; // Column index
         $columnName = $columnName_arr[$columnIndex]['data']; // Column name
         $columnSortOrder = $order_arr[0]['dir']; // asc or desc
   
         $searchValue = $search_arr['value']; // Search value

         // Total records
		 $totalRecords = Project::select('count(*) as allcount','projects');
		 
         if(!empty($searchValue)){
            $totalRecords->where('projects.name', 'like', '%' .$searchValue . '%');
            $totalRecords->orWhere('projects.created_at', 'like', '%' .$searchValue . '%');
         }
		  // if(Auth::user()->role_id === 3){
			// $totalRecords->where('status', false);
		// }
         
         $totalRecords = $totalRecords->count();

         $totalRecordswithFilter = Project::select('count(*) as allcount','projects');
		 
         if(!empty($searchValue)){
            $totalRecordswithFilter->where('projects.name', 'like', '%' .$searchValue . '%');
            $totalRecordswithFilter->orWhere('projects.created_at', 'like', '%' .$searchValue . '%');
         }
         // if(Auth::user()->role_id === 3){
			// $totalRecordswithFilter->where('status', false);
		// }
         $totalRecordswithFilter = $totalRecordswithFilter->count();
         // Fetch records
		$records = Project::orderBy('projects.created_at', 'desc');
		$records->orderBy($columnName,$columnSortOrder);
		
		if(!empty($searchValue)){
		    $records->where('projects.name', 'like', '%' .$searchValue . '%');
            $records->orWhere('projects.created_at', 'like', '%' .$searchValue . '%');
		}

		$records->select('projects.*');
		$records->skip($start);
		$records->take($rowperpage);
		// if(Auth::user()->role_id === 3){
			// $records->where('status', false);
		// }
		$records = $records->get();
        
        $data_arr = array();
        $sno = $start+1;
        $i = 1;
		foreach($records as $record){
			$name = $record->name;
			$logo = '<img src="/storage/'.$record->logo.'" style="width:150px">';
			$featuredImage = '<img src="/storage/'.$record->featured_image.'" style="width:150px">';
			$slno = $i++;
			$action = array();
			$id = base64_encode($record->id);
			$deleteConfirm = 'return myConfirm("projects/delete/'.$id.'")';
			$statusConfirm = 'return myConfirm("frontend-pages/projects/status/'.$id.'")';

			$view= "<a href='projects/details/".base64_encode($record->id)."' class='notPrintable btn btn-xs btn-info'><i class='fas fa-eye'></i></a>";
			
			$edit="<a href='projects/edit/".base64_encode($record->id)."' class='notPrintable btn btn-xs btn-info'><i class='fas fa-pen'></i></a>";
			
			if(userPermissions('delete', $moduleId)){
				$remove = "<a href='javascript: void(0)' class='notPrintable btn btn-xs btn-danger' onclick='$deleteConfirm'><i class='fas fa-times'></i></a>";
			}	
            $statusBtn = $record->status == 1 ? 'btn-info':'alert alert-info mb-0'; 
            $statusText = $record->status == 1 ? ' Active ' : ' Inactive '; 

			$status = "<a href='javascript: void(0)' class='notPrintable btn btn-xs {$statusBtn}'  style='padding:0.5rem' onclick='$statusConfirm'>{$statusText}</a>";
					   
			$action[] = $view." ".$edit." ".$remove;
			$data_arr[] = array(
			  "id" => $sno++,
			  "name" => ucfirst($name),             
			  "logo" => $logo,             
			  "featured_image" => $featuredImage,
			  'status' => $status,
			  'action' => $action
			);
		}
         //dd($data_arr); 
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
		$title = 'Create Project Details';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'projects.index' => 'Project Page', 
			'javascript:void(0);' => 'Create Project'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
		$projects = Project::where('status',false)->get();
		
        return view('admin.frontend.projects.add',compact('title','breadcrumbHtml','projects'));
	}
	public function store(Request $request){
		//dd($request->all());
		$request->validate([
			'name' => 'required|string|min:3',
			'owner_name' => 'required|string|min:3',
			'logo' => 'required|image|mimes:jpg,png,jpeg',
			'featured_image' => 'required|image|mimes:jpg,png,webp',
			'delivery_status' => 'required|in:new_launch,ready_to_move,under_construction,possession_within_year',
			'title' => 'required',
			'meta_description' => 'required',
            'location' => 'required',
            'city' => 'required',			
			'keywords' => 'required',
			'canonical_link' => 'required',
			'image_alt_tag' => 'required',
			'youtube_link' => 'required',
			'experience' => 'required',
			'initial_bsp_super_area' => 'required',
			'bsp_super_area' => 'required',
			'projects_delivered' => 'required',
			'ongoing_projects' => 'required',
			'area_built' => 'required',
			'compare_data' => 'required',
			'faqs_data' => 'required'
		]);
		
		// Store the thumbnail
        $logoPath = uploadFile($request->file('logo'),'projects'.'/'.createSlug($request->name));
        $featuredImagePath = uploadFile($request->file('featured_image'),'projects'.'/'.createSlug($request->name));
		
		$path = [];
		if(!empty($request->media) && count($request->media) > 0){
			foreach($request->media as $key => $mediaFile){
				$filePath = uploadFile($mediaFile,'projects'.'/'.createSlug($request->name));
				$path[$key] = $filePath;
			}
		}
		$mediaPath = json_encode($path);
		
		//To store the bhk plans
		$floorPlan = [];
		if(!empty($request->floor_plans) && count($request->floor_plans)>0){
			foreach($request->floor_plans as $key => $currentFloorPlan){
				$floorPlan[$key]['image'] = uploadFile($currentFloorPlan['feature_image'],'projects'.'/'.createSlug($request->name).'/BHKPlans');
				$floorPlan[$key]['super_area'] = $currentFloorPlan['super_area'];
				$floorPlan[$key]['carpet_area'] = $currentFloorPlan['carpet_area'];
				$floorPlan[$key]['built_area'] = $currentFloorPlan['built_area'];
				$floorPlan[$key]['balcony_area'] = $currentFloorPlan['balcony_area'];
				$floorPlan[$key]['title'] = $currentFloorPlan['title'];
			}
		}
		
		$floorPlanData = json_encode($floorPlan);
		
		//Store the FAQs of projects
		$faqData = [];
		if(!empty($request->faqs_data) && count($request->faqs_data)>0){
			foreach($request->faqs_data as $key => $currentFaqData){
				$faqData[$key]['question'] = $currentFaqData['question'];
				$faqData[$key]['answer'] = $currentFaqData['answer'];
			}
		}
		$totalFaqData = json_encode($faqData);
		
		// start the transaction for tables
		DB::beginTransaction();
		
		try {
			$project = new Project;
			$project->name = $request->name;
			$project->owner_name = $request->owner_name;
			$project->rera_no = $request->rera_no;
			$project->min_price = $request->min_price;
			$project->max_price = $request->max_price;
			$project->land_area = $request->land_area;
			$project->location = $request->location;
			$project->city = $request->city;
			$project->bhk_types = $request->bhk_types;
			$project->title = $request->title;
			$project->meta_description = $request->meta_description;
			$project->meta_tags = $request->meta_tags;
			$project->canonical_link = $request->canonical_link;
			$project->image_alt_tag = $request->image_alt_tag;
			$project->initial_bsp_super_area = $request->initial_bsp_super_area;
			$project->bsp_super_area = $request->bsp_super_area;
			$project->keywords = $request->keywords;
			$project->youtube_link = $request->youtube_link;			
			$project->logo = $logoPath; // Save the path to the logo
			$project->featured_image = $featuredImagePath; // Save the path to the featuredImage
			$project->delivery_status = $request->delivery_status;
			$project->status = false;
			$name = Str::slug($request->name); 
			$project->slug = $name;
			$project->compare_data = json_encode($request->compare_data);
			$project->faqs_data = $totalFaqData;
			$project->save();
			
			$projectId = $project->id;
			
			$location = new ProjectLocation;
			$location->project_id = $projectId;
			$location->locations_descp = $request->locations_descp;
			$location->save();
			
			$highlight = new ProjectHighlight;
			$highlight->project_id = $projectId;
			$highlight->towers = $request->towers;
			$highlight->parking = $request->parking;
			$highlight->density_unit_per_area = $request->density_unit_per_area;
			$highlight->no_of_apartments = $request->no_of_apartments;
			$highlight->lift_ratio = $request->lift_ratio;
			$highlight->highlights_descp = $request->highlights_descp;
			$highlight->save();
			
			$floorPlan = new ProjectFloorPlan;
			$floorPlan->project_id = $projectId;
			$floorPlan->floor_plans_descp = $request->floor_plans_descp;
			$floorPlan->floor_plans_data = $floorPlanData;
			$floorPlan->save();
			
			$possession = new ProjectPossession;
			$possession->project_id = $projectId;
			$possession->possessions_descp = $request->possessions_descp;
			$possession->launch_date = $request->launch_date;
			$possession->possession_rera_date = $request->possession_rera_date;
			$possession->save();
			
			$amenity = new ProjectAmenity;
			$amenity->project_id = $projectId;
			$amenity->amenities_descp = $request->amenities_descp;
			$amenity->save();
			
			$devBackground = new ProjectDevBackground;
			$devBackground->project_id = $projectId;
			$devBackground->experience = $request->experience;
			$devBackground->projects_delivered = $request->projects_delivered;
			$devBackground->ongoing_projects = $request->ongoing_projects;
			$devBackground->area_built = $request->area_built;
			$devBackground->dev_backgrounds_descp = $request->dev_backgrounds_descp;
			$devBackground->save();
			
			$pricing = new ProjectPricing;
			$pricing->project_id = $projectId;
			$pricing->pricings_descp = $request->pricings_descp;
			$pricing->save();
			
			$advices = new ProjectAdvice;
			$advices->project_id = $projectId;
			$advices->advices_descp = $request->advices_descp;
			$advices->save();
			
			$projectFile = new ProjectFile;
			$projectFile->project_id = $projectId;
			$projectFile->files = $mediaPath;
			$projectFile->save();
			
			DB::commit();
			return redirect()->route('projects.index')->with('success', 'Project has been uploaded successfully!');
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			DB::rollback();
			return back()->withInput()->withErrors(['error' => 'Something went wrong.']);
		}
		
        return redirect()->route('projects.index')->with('success', 'Project basic information uploaded successfully!');
	}
	public function edit($id){
		$title = 'Edit Project Details';
		$project = Project::with('locations', 'highlights', 'floorPlans', 'possessions', 'amenities', 'devBackgrounds', 'pricings', 'advices', 'files')->find(base64_decode($id));
		
		$decodedData = json_decode($project->compare_data);
		$files = json_decode($project->files->files);
		$project->compare_data = $decodedData;
		
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'projects.index' => 'Project Page', 
			'javascript:void(0);' => 'Edit Project'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
        return view('admin.frontend.projects.edit',compact('title','breadcrumbHtml', 'project','files'));
	}
	
	public function projectDetailsView(){
		$title = 'Project Details Page Design';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'youtube-videos.index' => 'Project Details Page',
			'javascript:void(0);' => 'View'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		
        return view('admin.frontend.projectDetails',compact('title','breadcrumbHtml'));
	}
	
	public function update(Request $request){ 
		try{
			$id = base64_decode($request->id);
			$project = Project::findOrFail($id);
			
			if(isset($request->logo)){
				$oldPath = $project->logo;
				if(removeFile($oldPath)){
					$logoPath = uploadFile($request->file('logo'),'projects'.'/'.createSlug($request->name));
					$project->logo = $logoPath;
				}
			}
			if(isset($request->featured_image)){
				$oldPath = $project->featured_image;
				if(removeFile($oldPath)){
					$featuredImagePath = uploadFile($request->file('featured_image'),'projects'.'/'.createSlug($request->name));
					$project->featured_image = $featuredImagePath;
				}
			}
			
			// start the transaction for tables
			DB::beginTransaction();
			
			$project->name = $request->name;
			$project->owner_name = $request->owner_name;
			$project->rera_no = $request->rera_no;
			$project->min_price = $request->min_price;
			$project->max_price = $request->max_price;
			$project->land_area = $request->land_area;
			$project->location = $request->location;
			$project->city = $request->city;
			$project->meta_tags = $request->meta_tags;
			$project->initial_bsp_super_area = $request->initial_bsp_super_area;
			$project->bsp_super_area = $request->bsp_super_area;
			$project->canonical_link = $request->canonical_link;
			$project->image_alt_tag = $request->image_alt_tag;
			$project->bhk_types = $request->bhk_types;
			$project->title = $request->title;
			$project->meta_description = $request->meta_description;
			$project->keywords = $request->keywords;
			$project->delivery_status = $request->delivery_status;
			$project->status = false;
			
			$name = Str::slug($request->name); 
			$project->slug = $name;
			
			$project->compare_data = json_encode($request->compare_data);
			
			//to update the FAQ Data
			if(!empty($request->faqs_data) && count($request->faqs_data)>0){
				$newFaqData = [];			
				foreach($request->faqs_data as $key => $faqData){
					$newFaqData[$key]['question'] = $faqData['question'];
					$newFaqData[$key]['answer'] = $faqData['answer'];
					
				}	
				$project->faqs_data = json_encode($newFaqData);	
			}
			
			$project->save();
			
			$location = ProjectLocation::where('project_id', $id)->first();
			$location->locations_descp = $request->locations_descp;
			$location->save();
				
			$highlight = ProjectHighlight::where('project_id', $id)->first();
			$highlight->towers = $request->towers;
			$highlight->parking = $request->parking;
			$highlight->density_unit_per_area = $request->density_unit_per_area;
			$highlight->no_of_apartments = $request->no_of_apartments;
			$highlight->lift_ratio = $request->lift_ratio;
			$highlight->highlights_descp = $request->highlights_descp;
			$highlight->save();
			
			//to update the bhk plans
			$floorPlanObj = ProjectFloorPlan::where('project_id', $id)->first();
			$floorPlanObj->floor_plans_descp = $request->floor_plans_descp;
			$oldFloorData = json_decode($floorPlanObj->floor_plans_data,true);			
						
			if(!empty($request->floor_plans) && count($request->floor_plans)>0){
				$newFloorData = [];			
				foreach($request->floor_plans as $key => $floorPlan){
					$newFloorData[$key]['title'] = $floorPlan['title'];
					$newFloorData[$key]['super_area'] = $floorPlan['super_area'];
					$newFloorData[$key]['carpet_area'] = $floorPlan['carpet_area'];
					$newFloorData[$key]['built_area'] = $floorPlan['built_area'];
					$newFloorData[$key]['balcony_area'] = $floorPlan['balcony_area'];
					
					//image 
					if(isset($floorPlan['feature_image'])){
						if(isset($oldFloorData[$key]['image']) && $oldFloorData[$key]['image'] != null){ 
							removeFile($oldFloorData[$key]['image']);
						}
						$newFloorData[$key]['image'] = uploadFile($floorPlan['feature_image'],'projects'.'/'.createSlug($request->name).'/BHKPlans');
					}else{
						$newFloorData[$key]['image'] = @$oldFloorData[$key]['image'];
					}
				}
				//if there is left any old image when request comes lesser than old ones
				if(count($oldFloorData) > count($request->floor_plans)){ 
					for($i= (count($oldFloorData) - (count($request->floor_plans) + 1)); $i < count($oldFloorData); $i++ ){
						removeFile($oldFloorData[$i]['image']); 
					}
				}
				$floorPlanObj->floor_plans_data = json_encode($newFloorData);	
			}
			$floorPlanObj->save();
			
			
			
			$possession = ProjectPossession::where('project_id', $id)->first();
			$possession->possessions_descp = $request->possessions_descp;
			$possession->launch_date = $request->launch_date;
			$possession->possession_rera_date = $request->possession_rera_date;
			$possession->save();
			
			$amenity = ProjectAmenity::where('project_id', $id)->first();
			$amenity->amenities_descp = $request->amenities_descp;
			$amenity->save();
			
			$devBackground = ProjectDevBackground::where('project_id', $id)->first();
			$devBackground->experience = $request->experience;
			$devBackground->projects_delivered = $request->projects_delivered;
			$devBackground->ongoing_projects = $request->ongoing_projects;
			$devBackground->area_built = $request->area_built;
			$devBackground->dev_backgrounds_descp = $request->dev_backgrounds_descp;
			$devBackground->save();
			
			$pricing = ProjectPricing::where('project_id', $id)->first();
			$pricing->pricings_descp = $request->pricings_descp;
			$pricing->save();
			
			$advices = ProjectAdvice::where('project_id', $id)->first();
			$advices->advices_descp = $request->advices_descp;
			$advices->save();
			
			//To update the projects files
			$projectFile = ProjectFile::where('project_id', $id)->first();
			$oldFiles = json_decode(json_decode($projectFile ,true)['files'] ,true);
			
			if(!empty($request->media) && count($request->media)>0 ){
				foreach($request->media as $key => $media){
					$path = [];
					if(isset($oldFiles[$key])){
						removeFile($oldFiles[$key]);
					} 
					$path = uploadFile($media, 'projects'.'/'.createSlug($request->name));
					$oldFiles[$key] = $path;
					$mediaPath = json_encode($oldFiles);
					$projectFile->files = $mediaPath;
				}
			}
			$projectFile->save(); 
			
			DB::commit();
			return redirect()->route('projects.index')->with('success', 'Project has been updated successfully!');
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			DB::rollback();
			return back()->withInput()->withErrors(['error' => 'Something went wrong.']);
		}
	}
	/**
    *
    * @Author- Mr. Aryan Raj
    * @Contact No.- 9827029863 / 9400365935
    * @email- aryanraj010010@gmal.com
    * @App-version 1.0
    * @description Project Page controller
    *
    * @Functions- Login System for the admin panel
    */
	public function changeStatus($id){
		try{
			$id = base64_decode($id);
			$project = Project::findOrFail($id);
			$project->status = (!$project->status);
			$project->save();
			return response()->json([
				"message" => "Status changed successfully",
				"status" => true
			]);
		}catch(\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return back()->withInput()->withErrors(['error' => 'Something went wrong.']);
		}
	}
		
	
	
}