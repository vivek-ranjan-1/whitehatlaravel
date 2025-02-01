<?php
namespace App\Http\Controllers\admin\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\HeroSection;
use App\Models\admin\DeveloperLogo;
use App\Models\admin\Slider;
use App\Models\admin\ToolInsight;
use App\Models\admin\TwoValueSystem;
use App\Models\admin\ThreeValueSystem;
use Illuminate\Support\Facades\Log;
use App\Models\CustomPage;

class HomePageController extends Controller
{
    //view page
	public function index(){
		$title = 'Home Page Design';
		$breadcrumbs = [
			'dashboard' => 'Dashboard',
			'home.index' => 'Home Page',
			'javascript:void(0);' => 'View'
		];
		$breadcrumbHtml = view('layouts.breadcrumb', compact('breadcrumbs','title'))->render();
		$page = CustomPage::find(1);
		$pageData = json_decode($page->page_content,true);
		// $seoData = CustomPage::find(1);
		$seoData = json_decode($page->seo_data,true); 
        return view('admin.frontend.home.view',compact('title','breadcrumbHtml','pageData','seoData'));  
	}
	
	
	public function store(Request $request){
		try{
			$customRequest = [];
			
			$request->validate([
				'page_content' => 'required',  
				'seo_data' => 'required'
			]);
			
			$pageContent = $request->page_content;
			
			//convert all the request into array
			$customRequest = $request->all();
			$pageId = $customRequest['page_id'];
			$customPageObj = (CustomPage::find(base64_decode($pageId)) != null) ? CustomPage::find(base64_decode($pageId)) : new CustomPage;
			$oldData = json_decode($customPageObj->page_content,true);
			
			if(isset($customRequest['page_content']['heroImage']) && $customRequest['page_content']['heroImage'] !== null ){
				$customRequest['page_content']['heroImage'] = uploadFile($customRequest['page_content']['heroImage'], 'pages/home');
			}else{
				$customRequest['page_content']['heroImage'] = @$oldData['heroImage'];
			}
			
			if(isset($customRequest['page_content']['fistBanner']) && $customRequest['page_content']['fistBanner'] !== null ){
				$customRequest['page_content']['fistBanner'] = uploadFile($customRequest['page_content']['fistBanner'], 'pages/home');
			}else{
				$customRequest['page_content']['fistBanner'] = @$oldData['fistBanner'];
			}
			
            if(isset($customRequest['page_content']['secondBanner']) && $customRequest['page_content']['secondBanner'] !== null ){
				$customRequest['page_content']['secondBanner'] = uploadFile($customRequest['page_content']['secondBanner'], 'pages/home');
			}else{
				$customRequest['page_content']['secondBanner'] = @$oldData['secondBanner']; 
			}
			
			if(isset($customRequest['page_content']['thirdBanner']) && $customRequest['page_content']['thirdBanner'] !== null ){
				$customRequest['page_content']['thirdBanner'] = uploadFile($customRequest['page_content']['thirdBanner'], 'pages/home');
			}else{
				$customRequest['page_content']['thirdBanner'] = @$oldData['thirdBanner'];
			}
			
			if(isset($customRequest['page_content']['fourthBanner']) && $customRequest['page_content']['fourthBanner'] !== null ){
				$customRequest['page_content']['fourthBanner'] = uploadFile($customRequest['page_content']['fourthBanner'], 'pages/home');
			}else{
				$customRequest['page_content']['fourthBanner'] = @$oldData['fourthBanner'];
			}
			
			if(isset($customRequest['page_content']['mobileFistBanner']) && $customRequest['page_content']['mobileFistBanner'] !== null ){
				$customRequest['page_content']['mobileFistBanner'] = uploadFile($customRequest['page_content']['mobileFistBanner'], 'pages/home');
			}else{
				$customRequest['page_content']['mobileFistBanner'] = @$oldData['mobileFistBanner'];
			}
			
            if(isset($customRequest['page_content']['mobileSecondBanner']) && $customRequest['page_content']['mobileSecondBanner'] !== null ){
				$customRequest['page_content']['mobileSecondBanner'] = uploadFile($customRequest['page_content']['mobileSecondBanner'], 'pages/home');
			}else{
				$customRequest['page_content']['mobileSecondBanner'] = @$oldData['mobileSecondBanner']; 
			}
			
			if(isset($customRequest['page_content']['mobileThirdBanner']) && $customRequest['page_content']['mobileThirdBanner'] !== null ){
				$customRequest['page_content']['mobileThirdBanner'] = uploadFile($customRequest['page_content']['mobileThirdBanner'], 'pages/home');
			}else{
				$customRequest['page_content']['mobileThirdBanner'] = @$oldData['mobileThirdBanner'];
			}
			
			if(isset($customRequest['page_content']['mobileFourthBanner']) && $customRequest['page_content']['mobileFourthBanner'] !== null ){
				$customRequest['page_content']['mobileFourthBanner'] = uploadFile($customRequest['page_content']['mobileFourthBanner'], 'pages/home');
			}else{
				$customRequest['page_content']['mobileFourthBanner'] = @$oldData['mobileFourthBanner'];
			}
 
			if(isset($customRequest['page_content']['propertyGif']) && $customRequest['page_content']['propertyGif'] !== null ){
				$customRequest['page_content']['propertyGif'] = uploadFile($customRequest['page_content']['propertyGif'], 'pages/home');
			}else{
				$customRequest['page_content']['propertyGif'] = @$oldData['propertyGif'];
			}
			
			if(isset($customRequest['page_content']['ads_images']) && $customRequest['page_content']['ads_images'] !== null ){
				$customRequest['page_content']['ads_images'] = uploadFile($customRequest['page_content']['ads_images'], 'pages/home');
			}else{
				$customRequest['page_content']['ads_images'] = @$oldData['ads_images'];
			}
			
			$pageData = json_encode($customRequest['page_content']);
			$seoData = json_encode($customRequest['seo_data']);
			

			
			$customPageObj->seo_data = $seoData;
			$customPageObj->page_content = $pageData;
			$customPageObj->save();
			return redirect()->route('home.index')->with('success','Uploaded Successfully.');
		}catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}

	//create the hero image section\
	public function createHeroSection(Request $request){
		$request->validate([
			'title' => 'required',
            'note'  => 'nullable|string|max:255',
            'hero_image' => 'required'
        ]);
		// Store the thumbnail
        $imagePath   = uploadFile($request->file('hero_image'),'hero_images');
		$heroSection = (HeroSection::first() === null) ? (New HeroSection) : (HeroSection::first());
		$heroSection->hero_image = $imagePath;
		$heroSection->note  = $request->note;
		$heroSection->title = $request->title;
		$heroSection->save();

		return redirect()->route('home.index')->with('success', 'HeroSection is stored!');
	}
	
	public function createDeveloperLogo(Request $request){
		$request->validate([
			'title' => 'required',
            'note'  => 'nullable|string|max:255',
            'image' => 'required'
        ]);
		
		// Store the thumbnail
        $imagePath     = uploadFile($request->file('image'),'developer_logos');
		$developerLogo = New DeveloperLogo;
		$developerLogo->image  = $imagePath;
		$developerLogo->title  = $request->title;
		$developerLogo->status = true;
		$developerLogo->save();

		return redirect()->route('home.index')->with('success', 'Developer logo is stored!'); 
	}
	
	public function deleteDeveloperLogo($id){
		$logo    = developerLogo::find(base64_decode($id));
		$oldPath = $logo->image;
		removeFile($oldPath);
		$logo->delete(); 
		return redirect()->route('home.index')->with('success', 'Developer logo is deleted!'); 
	}
	
	public function createSliders(Request $request){
		$request->validate([
			'title' => 'required',
            'image' => 'required'
        ]);
		
        $imagePath     = uploadFile($request->file('image'),'sliders');
		$slider 	   = New Slider;
		$slider->image = $imagePath;
		$slider->title = $request->title;
		$slider->save();

		return redirect()->route('home.index')->with('success', 'Slider is stored!'); 
	}
	
	public function deleteSlider($id){
		$slider    = Slider::find(base64_decode($id));
		$oldPath = $slider->image;
		removeFile($oldPath);
		$slider->delete(); 
		return redirect()->route('home.index')->with('success', 'Developer slider is deleted!'); 
	}
	
	public function createToolInsight(Request $request){
		$request->validate([
			'title' => 'required',
			'icon' => 'required',
			'description' => 'nullable',
            'url' => 'required'
        ]);
		
        $imagePath     = uploadFile($request->file('icon'),'tools_icons');
		$tool 	    = New ToolInsight;
		$tool->icon = $imagePath;
		$tool->url = $request->url;
		$tool->description = $request->description;
		$tool->title= $request->title;
		$tool->save();

		return redirect()->route('home.index')->with('success', 'Slider is stored!'); 
	}

	public function deleteToolInsights($id){
		$toolInsight = ToolInsight::find(base64_decode($id));
		$oldPath	 = $toolInsight->icon;
		removeFile($oldPath);
		//$toolInsight->delete(); 
		return redirect()->route('home.index')->with('success', 'Tool Insight is deleted!'); 
	}
	
	public function createValueSystems(Request $request){
		$request->validate([
			'title' => 'required',
			'description' => 'required',
            'image' => 'required'
        ]);
		
        $imagePath     = uploadFile($request->file('image'),'two_value_systems');
		
		$twoValueSystem = New TwoValueSystem;
		$twoValueSystem->image = $imagePath;
		$twoValueSystem->title = $request->title;
		$twoValueSystem->description = $request->description;
		$twoValueSystem->save();

		return redirect()->route('home.index')->with('success', 'Value System is stored!'); 
	}
	
	public function createThreeValueSystems(Request $request){
		$request->validate([
			'title' => 'required',
			'description' => 'required',
            'image' => 'required',
			'video' => 'required'
        ]);
		
        $imagePath     = uploadFile($request->file('image'),'three_value_systems');
        $videoPath     = uploadFile($request->file('video'),'three_value_systems');
		
		$threeValueSystem = New ThreeValueSystem;
		$threeValueSystem->image = $imagePath;
		$threeValueSystem->video = $videoPath;
		$threeValueSystem->title = $request->title;
		$threeValueSystem->description = $request->description;
		$threeValueSystem->save();

		return redirect()->route('home.index')->with('success', 'Three Value System is stored!'); 
	}
	public function getHomeData(){
		
	}
}
