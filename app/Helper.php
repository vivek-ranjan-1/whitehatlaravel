<?php

	use GeoIp2\Database\Reader;
	use App\Models\admin\Permission;
	use App\Models\admin\Module;
	use Illuminate\Support\Facades\Auth;

    //Create log
    if(!function_exists('create_log')){
	    function create_log($activity = null) {       
	        $data = array();	              
	        $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
	        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
	        $data['city'] 	= getLocation($_SERVER['REMOTE_ADDR'])['city']." ".getLocation($_SERVER['REMOTE_ADDR'])['country'];;
	        $data['activity'] 	= $activity;
	        // $data['status'] 	= 1;
	        $data['created_at'] = date('Y-m-d H:i:s');
	        $data['created_at'] = date('Y-m-d H:i:s');
	        DB::table('activities')->insert($data);
	    }
	}
    // function for date formatting
	if(!function_exists('formatDate')){
		function formatDate($date){
			return date('Y-m-d H:i:s a', strtotime($date));
		}
	}
	// To get the location from the ip address
	if(!function_exists('getLocation')){
		function getLocation($ipAddress){
			$reader = new Reader('public/assets/libraries/GeoLite2-City.mmdb'); 
			$ipAddress = $ipAddress;
			try{
			   $record = $reader->city($ipAddress);
			   $location = [];
			   $location['city'] = $record->city->name;
			   $location['country'] = $record->country->name;
			   $location['latitude'] = $record->location->latitude;
			   $location['longitude'] = $record->location->longitude;
			   return $location;			   
			}
			catch (\Exception $e) {
                  echo "Error: " . $e->getMessage();
            }
		}
	}
	// for file uploading
    // if(!function_exists('uploadFile')){
		// function uploadFile($file, $location, $prefix = 'white_hat_realty')
		// {
			// $fileName = createSlug($prefix . '_' . Str::random(10) . '_' . $file->getClientOriginalName());
			// $url = $file->storeAs($location, $fileName, 'public');
			// return $url;
		// }
	// }
	if (!function_exists('uploadFile')) {
       function uploadFile($file, $location, $prefix = 'white_hat_realty')
        {
            // Get the original file name and extension
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            // Generate a unique and clean file name
            $fileName = createSlug($prefix . '_' . Str::random(10) . '_' . pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

            // Store the file
            $url = $file->storeAs($location, $fileName, 'public');

            return $url;
        }
    }

	
	// for remove file
	if(!function_exists('removeFile')){
		function removeFile($filePath){
			try {
				if (Storage::disk('public')->exists($filePath)) {
					Storage::disk('public')->delete($filePath);
					return true;
				}
				return false;
			} catch (\Exception $e) {
				return false;
			}
		}
	}
	// for data sanitization
	if(!function_exists('clean')){
		function clean($string) {
        return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
       }
	}
	
	if(!function_exists('deliveryStatus')){
		function deliveryStatus($status){
			switch($status){
				case 'new_launch':
					return 'New Launch';
					break;
				case 'ready_to_move':
					return 'Ready To Move';
					break;
				case 'under_construction':
					return 'Under Construction';
					break;
				case 'possession_within_year':
					return 'Possession Within Year';
					break;
				default:
					return 'Bad Method';
					break;
			}
		}
	}
	// if(!function_exists('createSlug')){
		// function createSlug($string) {
			////Convert the string to lowercase
			// $slug = strtolower($string);
			
			////Remove any characters that are not alphanumeric, spaces, or hyphens
			// $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
			
			////Replace multiple spaces or hyphens with a single hyphen
			// $slug = preg_replace('/[\s-]+/', '-', $slug);
			
			////Trim hyphens from the beginning and end of the slug
			// $slug = trim($slug, '-');
			
			// return $slug;
		// }
	// }
	function createSlug($string)
    {
       $slug = Str::slug(pathinfo($string, PATHINFO_FILENAME));
       $extension = pathinfo($string, PATHINFO_EXTENSION);

       return $extension ? $slug . '.' . $extension : $slug;
    }
	
	function userPermissions($operation, $moduleId){
		$roleId = Auth::user()->role_id;
		$permissionObj = Permission::where(['module_id' => $moduleId,'role_id' => $roleId])->first();
		if($permissionObj != null){
			$permissions = json_decode($permissionObj->permissions, true);
			return (in_array($operation, $permissions)) ? true : false;
		}else{
			return false;
		}
	}  
	
	function isMenuValid($module){
		$roleId = Auth::user()->role_id;
		$moduleId = Module::where('url',$module)->first()?->id;
		$permissionObj = Permission::where(['module_id' => $moduleId,'role_id' => $roleId])->first();
		if($permissionObj != null){
			return true;
		}else{
			return false;
		}
	}
 
	
	
	