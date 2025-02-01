<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\API\ApiController; 
use App\Http\Controllers\NewsletterController;

use App\Http\Controllers\admin\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'v1'],function(){	
	Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
		return $request->user();
	});
	Route::get('get-page-data/{id}',[ApiController::class,'getPageData']);
	Route::get('get-project',[ApiController::class,'getProject']);  
	Route::get('project-detail/{slug}',[ApiController::class,'getProjectDetail']);
	Route::get('search', [ApiController::class, 'searchProjects'])->name('search-projects');
	// Route::get('most-searched/{city}', [ApiController::class, 'mostSearchedProjects'])->name('most-searched');
	Route::get('most-searched', [ApiController::class, 'mostSearchedProjects'])->name('most-searched');
	Route::get('get-city', [ApiController::class, 'getCity'])->name('get-city');

	
	Route::post('send-otp', [ApiController::class, 'sendOtp'])->name('send-otp');
	Route::post('verify-otp', [ApiController::class, 'verifyOtp'])->name('verify-otp');
	
	Route::get('compare-listing', [ApiController::class, 'compareListing'])->name('compare-listing');
	
	Route::post('compare-data', [ApiController::class, 'getCompareData'])->name('compare-data');
	
	Route::get('youtube-videos',[DashboardController::class,'LoadVideo']);
	
	
	
	//blogs api
	Route::group(['prefix' => 'blogs'],function(){
		//GET METHODS
		Route::get('/', [ApiController::class, 'getAllBlogs']); 
		Route::get('single-page/{slug}', [ApiController::class, 'getBlog'])->name('single-blogs'); 
		Route::get('search', [ApiController::class, 'searchBlog'])->name('search-blog');
	});
	
	Route::post('contact-mail',[SendMailController::class,'SendContactMail']);
	Route::post('subscribe', [ApiController::class, 'UserSubscribers']); 
	Route::GET('send-message', [ApiController::class, 'sendSmsonPhone' ]);
	
	Route::post('get-meta-data', [ApiController::class, 'getGraphApiData' ]);
	Route::post('refresh-token', [\App\Http\Controllers\SocialMedia\SocialMediaService::class, 'refreshPageToken' ]);
	
	Route::get('get-filters-data',[ApiController::class, 'getFiltersData' ]);
	
});



Route::group(['prefix' => 'v2'],function(){	
	Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
		return $request->user();
	});
	Route::POST('get-page-data',[ApiController::class,'getPageData'])->name('page-data');
	Route::POST('get-projects',[ApiController::class,'getProject'])->name('getProject');
	Route::get('project-detail/{slug}',[ApiController::class,'getProjectDetail']);
	Route::get('search', [ApiController::class, 'searchProjects'])->name('search-projects');
	Route::get('most-searched', [ApiController::class, 'mostSearchedProjects'])->name('most-searched');
	Route::post('get-city', [ApiController::class, 'getCity'])->name('get-city'); 

	
	Route::post('send-otp', [ApiController::class, 'sendOtp'])->name('send-otp');
	Route::post('verify-otp', [ApiController::class, 'verifyOtp'])->name('verify-otp');
	
	Route::get('compare-listing', [ApiController::class, 'compareListing'])->name('compare-listing');
	
	Route::post('compare-data', [ApiController::class, 'getCompareData'])->name('compare-data');
	
	Route::get('youtube-videos',[DashboardController::class,'LoadVideo']);
	
	
	
	//blogs api
	Route::group(['prefix' => 'blogs'],function(){
		//GET METHODS
		Route::get('/', [ApiController::class, 'getAllBlogs']); 
		Route::get('single-page/{slug}', [ApiController::class, 'getBlog'])->name('single-blogs'); 
		Route::get('search', [ApiController::class, 'searchBlog'])->name('search-blog');
	});
	
	Route::post('contact-mail',[SendMailController::class,'SendContactMail']);
	Route::post('subscribe', [ApiController::class, 'UserSubscribers']); 
	Route::GET('send-message', [ApiController::class, 'sendSmsonPhone' ]);
	
	Route::post('get-meta-data', [ApiController::class, 'getGraphApiData' ]);
	Route::post('refresh-token', [\App\Services\SocialMediaService::class, 'refreshPageToken' ]);
	
	Route::get('get-filters-data',[ApiController::class, 'getFiltersData' ]);
	
});
