<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\YoutubeVideoController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\QueryController;
use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\NewsletterMessageController;
use App\Http\Controllers\admin\frontend\HomePageController;
use App\Http\Controllers\admin\frontend\ProjectPageController;
use App\Http\Controllers\admin\authorizations\ModuleController;
use App\Http\Controllers\admin\authorizations\PermissionController;

Route::group(['prefix' => '7439','middleware' => ['admin', 'PreventBackPage']], function(){

    //GET METHODS
    Route::get('login',[AuthController::class,'loginView']);
    //POST METHODS
    Route::post('login',[AuthController::class,'login'])->name('login');

    route::get('logout',[AuthController::class,'logout'])->name('logout');

    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
	Route::get('dashboard/ajax-list',[DashboardController::class,'ajaxList'])->name('dashboard.ajax-list');

    Route::group(['prefix' => 'organizations'],function(){
        // GET METHODS
        // Route::get('',[OrganizationController::class,'index'])->name('organizations.index');

        // POST METHODS
        
    });

    Route::group(['prefix' => 'youtube-videos', 'middleware' => ['IsValidUser']],function(){
        // GET METHODS
        Route::GET('',[YoutubeVideoController::class,'index'])->name('youtube-videos.index');
        Route::GET('create',[YoutubeVideoController::class,'create'])->name('youtube-videos.create');
        Route::GET('edit/{id}',[YoutubeVideoController::class,'edit'])->name('youtube-videos.edit');
        Route::GET('ajax-list',[YoutubeVideoController::class,'ajaxList'])->name('youtube-videos.ajax-list');
        Route::GET('delete/{id}',[YoutubeVideoController::class,'softDelete'])->name('youtube-videos.soft-delete');
        Route::GET('status/{id}',[YoutubeVideoController::class,'changeStatus'])->name('youtube-videos.status');
        Route::GET('trending/{id}',[YoutubeVideoController::class,'changeTrending'])->name('youtube-videos.trending');

        // POST METHODS
        Route::POST('store',[YoutubeVideoController::class,'store'])->name('youtube-videos.store');;
        Route::POST('update',[YoutubeVideoController::class,'update'])->name('youtube-videos.update');
    });
	
	
	Route::group(['prefix' => 'queries', 'middleware' => ['IsValidUser']],function(){
		//GET METHODS
		Route::GET('/',[QueryController::class,'index'])->name('queries.index');
		Route::GET('ajax-list',[QueryController::class,'ajaxList'])->name('queries.ajax-list');
		Route::GET('view/{id}',[QueryController::class,'view'])->name('queries.view');
		
		//POST METHODS
        Route::POST('reply',[QueryController::class,'reply'])->name('queries.reply');
		
	});
	
	//newsletter
	Route::group(['prefix' => 'newsletter', 'middleware' => ['IsValidUser']],function(){
		//GET METHODS
		Route::GET('/',[NewsletterMessageController::class,'index'])->name('message.index');
		
		//Post Methods 
		Route::POST('store', [NewsletterMessageController::class, 'store'])->name('message.store');
	});
	
	
	Route::group(['prefix' => 'profile', 'middleware' => ['IsValidUser']],function(){
		Route::get('edit',[AuthController::class,'editProfile'])->name('edit-profile');
		Route::get('/',[AuthController::class,'editProfile'])->name('user-profile'); 
		
		//post method
		Route::post('password/edit', [AuthController::class, 'updatePassword'])->name('password.update');
	});
	
	
	
	Route::group(['prefix' => 'settings', 'middleware' => ['IsValidUser']],function(){
		
		Route::GET('/',[SettingsController::class,'index'])->name('settings.index');
		Route::get('change-mode',[SettingsController::class,'changeMode'])->name('settings.change-mode');
		
		
		//Post Methods 
		Route::POST('store-credentials', [SettingsController::class, 'store'])->name('credentials.store');
		
		Route::POST('store-users', [SettingsController::class, 'storeUser'])->name('users.store');
		
	});
	
	Route::group(['prefix' => 'frontend-pages', 'name' => 'frontend-pages' , 'middleware' => ['IsValidUser']], function(){
		
		Route::group(['prefix' => 'home'],function(){
			
			//Get Mehtods
			Route::GET('/', [HomePageController::class,'index'])->name('home.index');
			
			//Post Methods 
			Route::post('store', [HomePageController::class, 'store'])->name('home.store');
			
			
			// Route::GET('developer-logo/delete/{id}',[HomePageController::class,'deleteDeveloperLogo'])->name('developer-logo.delete');
			// Route::GET('sliders/delete/{id}',[HomePageController::class,'deleteSlider'])->name('sliders.delete');
			// Route::GET('tools-insights/delete/{id}',[HomePageController::class,'deleteToolInsights'])->name('tools-insights.delete');
			
			
			// POST 
			// Route::POST('create-hero-section',[HomePageController::class,'createHeroSection'])->name('hero-section.store');
			// Route::POST('create-developer-logo',[HomePageController::class,'createDeveloperLogo'])->name('developer-logo.store');
			// Route::POST('create-tools-insights',[HomePageController::class,'createToolInsight'])->name('tool-insights.store');
			// Route::POST('create-sliders',[HomePageController::class,'createSliders'])->name('sliders.store');
			// Route::POST('create-two-value-systems',[HomePageController::class,'createValueSystems'])->name('two-value-system.store');
			// Route::POST('create-three-value-systems',[HomePageController::class,'createThreeValueSystems'])->name('three-value-system.store');
			
			 
		});
		Route::group(['prefix' => 'projects'],function(){
			Route::GET('/',[ProjectPageController::class,'index'])->name('projects.index');
			Route::GET('add',[ProjectPageController::class,'add'])->name('projects.add');
			Route::GET('edit/{id}',[ProjectPageController::class,'edit'])->name('projects.edit');
			Route::GET('details/{id}',[ProjectPageController::class,'projectDetailsView'])->name('project.details'); 
			Route::GET('ajax-list',[ProjectPageController::class,'ajaxList'])->name('projects.ajax-list');
			Route::GET('delete/{id}',[ProjectPageController::class,'softDelete'])->name('projects.soft-delete');
			Route::GET('status/{id}',[ProjectPageController::class,'changeStatus'])->name('projects.change-status');
			//post method
			Route::POST('store',[ProjectPageController::class,'store'])->name('projects.store');
			Route::POST('update',[ProjectPageController::class,'update'])->name('projects.update'); 
		});
		Route::group(['prefix' => 'blogs'],function(){
			//GET
			Route::GET('/',[BlogsController::class,'index'])->name('blogs.index');
			Route::GET('add',[BlogsController::class,'add'])->name('blogs.add');
			Route::GET('ajax-list',[BlogsController::class,'ajaxList'])->name('blogs.ajax-list');
			Route::GET('edit/{id}',[BlogsController::class,'edit'])->name('blogs.edit');
			Route::GET('delete/{id}',[BlogsController::class,'moveToBin'])->name('blogs.delete');
			Route::GET('status/{id}',[BlogsController::class,'changeStatus'])->name('blogs.change-status');
			
			//POST
			Route::POST('store',[BlogsController::class,'store'])->name('blogs.store');
			Route::POST('update',[BlogsController::class,'update'])->name('blogs.update');
			Route::POST('upload-image',[BlogsController::class,'uploadImage']); 
			
		});
		
		
		Route::group(['prefix' => 'modules'] ,function(){ 
			//GET
			Route::GET('/',[ModuleController::class,'add'])->name('modules.add');
			
			Route::POST('store',[ModuleController::class,'store'])->name('modules.store');
		});
		
		Route::group(['prefix' => 'permissions'] ,function(){ 
			//GET
			Route::GET('/',[PermissionController::class, 'add'])->name('permissions.view');
			
			//POST
			Route::POST('store',[PermissionController::class, 'store'])->name('permissions.store');
		});
		
	});
	
	
});



Route::get('',[DashboardController::class,'comingSoon'])->name('coming-soon');
Route::get('load-video',[DashboardController::class,'LoadVideo'])->name('load-video');
Route::post('contact-mail',[SendMailController::class,'SendContactMail'])->name('contact-mail');



Route::get('clear',function(){
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('clear-compiled');
        Artisan::call('optimize:clear');
        
        return "Caches cleared successfully.";
});

