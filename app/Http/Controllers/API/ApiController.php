<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Exceptions\RouteNotFoundException;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\HeroSection;
use App\Models\admin\DeveloperLogo;
use App\Models\admin\Slider;
use App\Models\admin\ToolInsight;
use App\Models\admin\TwoValueSystem;
use App\Models\admin\ThreeValueSystem;
use App\Models\admin\Project;
use Storage;
use App\Models\User;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CompareListingResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\VonageService;
use Carbon\Carbon;
use App\Models\CustomPage;
use App\Models\admin\Blog;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Http;
use App\Services\SocialMediaService;
use Illuminate\Support\Facades\Validator;


class ApiController extends Controller
{
	protected $vonageService;

	public function __construct(VonageService $vonageService)
	{
		$this->vonageService = $vonageService;
	}

	public function getPageData(Request $request)
	{
		try {
			$pageData = CustomPage::findOrFail(base64_decode($request->pageId));
			$pageData->page_content = json_decode($pageData->page_content);
			$pageData->seo_data = json_decode($pageData->seo_data);
			// dd($pageData);
			$pageData->page_content->fistBanner = url('storage/' . $pageData->page_content->fistBanner);
			$pageData->page_content->secondBanner = url('storage/' . $pageData->page_content->secondBanner);
			$pageData->page_content->thirdBanner = url('storage/' . $pageData->page_content->thirdBanner);
			$pageData->page_content->fourthBanner = url('storage/' . $pageData->page_content->fourthBanner);
			$pageData->page_content->mobileFistBanner = url('storage/' . $pageData->page_content->mobileFistBanner);
			$pageData->page_content->mobileSecondBanner = url('storage/' . $pageData->page_content->mobileSecondBanner);
			$pageData->page_content->mobileThirdBanner = url('storage/' . $pageData->page_content->mobileThirdBanner);
			$pageData->page_content->mobileFourthBanner = url('storage/' . $pageData->page_content->mobileFourthBanner);
			$pageData->page_content->propertyGif = url('storage/' . $pageData->page_content->propertyGif);
			$pageData->page_content->ads_images = url('storage/' . $pageData->page_content->ads_images);
			$pageData->page_content->heroImage = url('storage/' . $pageData->page_content->heroImage);
			return response()->json([
				'data' => $pageData,
				'message' => 'Data fetched successfully.',
				'status' => true
			], 200);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}

	public function getAllBlogs()
	{
		try {
			$blogs = Blog::where('status', true)
				->orderBy('created_at', 'desc')
				->paginate(10);

			return response()->json([
				'data' =>	BlogResource::collection($blogs),
				'message' => 'Blogs fetched successfully.',
				'status' => true
			], 200);
		} catch (\Exception $e) {
			Log::error('Error fetching blogs: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}

	public function getBlog($slug)
	{
		try {

			$blog = Blog::where('slug', $slug)->firstOrFail();
			$blog->seo_data = json_decode($blog->seo_data);
			$blog->featured_image = url('storage/' . $blog->featured_image);
			$blog->status = (bool) $blog->status;
			$blog->description = $this->updateImageSrc($blog->description);

			return response()->json([
				'data' => $blog,
				'message' => 'Blog fetched successfully.',
				'status' => true
			], 200);
		} catch (\Exception $e) {
			Log::error('Error fetching blog: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}

	private function updateImageSrc($description)
	{
		// Pattern to match img src attribute
		$pattern = '/<img[^>]+src="([^"]+)"/i';

		// Replace the src with the modified path
		$description = preg_replace_callback($pattern, function ($matches) {
			$originalSrc = $matches[1];

			// Check if the src is a relative path
			if (!preg_match('/^https?:\/\//', $originalSrc)) {
				$newSrc = 'https://whitehatrealty.in/' . ltrim($originalSrc, '/');
				return str_replace($matches[1], $newSrc, $matches[0]);
			}

			return $matches[0]; // Return original if already an absolute path
		}, $description);

		return $description;
	}

	public function getHomeData2()
	{
		try {
			$data['heroSection'] = HeroSection::firstOrFail();
			$data['heroSection']->hero_image = url('storage/' . $data['heroSection']->hero_image);
			$data['developerLogos'] = DeveloperLogo::get();
			$data['developerLogos'] = $data['developerLogos']->map(function ($item) {
				$item->image = url('storage/' . $item->image);
				return $item;
			});

			$data['sliders'] = Slider::orderBy('id', 'DESC')->take(4)->get();
			$data['sliders'] = $data['sliders']->map(function ($item) {
				$item->image = url('storage/' . $item->image);
				return $item;
			});

			$data['insights'] = ToolInsight::orderBy('id', 'DESC')->get();
			$data['insights'] = $data['insights']->map(function ($item) {
				$item->icon = url('storage/' . $item->icon);
				return $item;
			});

			$data['twoValuesSystem'] = TwoValueSystem::orderBy('id', 'DESC')->get();
			$data['twoValuesSystem'] = $data['twoValuesSystem']->map(function ($item) {
				$item->image = url('storage/' . $item->image);
				return $item;
			});

			$data['threeValuesSystem'] = ThreeValueSystem::orderBy('id', 'DESC')->get();
			$data['threeValuesSystem'] = $data['threeValuesSystem']->map(function ($item) {
				$item->image = url('storage/' . $item->image);
				return $item;
			});

			return response()->json([
				'message' => 'Data fetched successfully.',
				'status'  => true,
				'data' => $data
			], 200);
		} catch (ModelNotFoundException $e) {
			Log::error('Model not found: ' . $e->getMessage());
			return response()->json([
				'message' => 'Model not found.',
				'status' => false
			], 404);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}

	public function getAboutData()
	{
		try {
			$data['heroSection'] = HeroSection::firstOrFail();
			$data['heroSection']->hero_image = url('storage/' . $data['heroSection']->hero_image);
			$data['developerLogos'] = DeveloperLogo::get();
			$data['developerLogos'] = $data['developerLogos']->map(function ($item) {
				$item->image = url('storage/' . $item->image);
				return $item;
			});

			$data['sliders'] = Slider::orderBy('id', 'DESC')->take(4)->get();
			$data['sliders'] = $data['sliders']->map(function ($item) {
				$item->image = url('storage/' . $item->image);
				return $item;
			});

			$data['insights'] = ToolInsight::orderBy('id', 'DESC')->get();
			$data['insights'] = $data['insights']->map(function ($item) {
				$item->icon = url('storage/' . $item->icon);
				return $item;
			});

			$data['twoValuesSystem'] = TwoValueSystem::orderBy('id', 'DESC')->get();
			$data['twoValuesSystem'] = $data['twoValuesSystem']->map(function ($item) {
				$item->image = url('storage/' . $item->image);
				return $item;
			});

			$data['threeValuesSystem'] = ThreeValueSystem::orderBy('id', 'DESC')->get();
			$data['threeValuesSystem'] = $data['threeValuesSystem']->map(function ($item) {
				$item->image = url('storage/' . $item->image);
				return $item;
			});

			return response()->json([
				'message' => 'Data fetched successfully.',
				'status'  => true,
				'data' => $data
			], 200);
		} catch (ModelNotFoundException $e) {
			Log::error('Model not found: ' . $e->getMessage());
			return response()->json([
				'message' => 'Model not found.',
				'status' => false
			], 404);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}

	public function getProject(Request $request)
	{
		try {
			
			$pageId = $request->page ?? 1;
			$perPage = 10;

			$keyword = $request->keyword;
			$filter = json_decode(@$request->query('filter'), true);
			$cities = @$filter['cities'];
			
			$bhkTypes  = [];
			$bhkTypes = @$filter['bhk_type'];
			$projectStatus = @$filter['status'];
			$budget = @$filter['budget'];

			$query = Project::where('status', true)->with('highlights')->orderBy('created_at', 'ASC');
			if (isset($keyword)) {
				$query->where('name', 'like', '%' . $keyword . '%');
			}
			$query->where(function ($query) use ($cities) {
				if (isset($cities)) {
					foreach ($cities as $city) {
						$query->orWhere('city', $city);
					}
				}
			});
			$query->where(function ($query) use ($bhkTypes) {
				if (isset($bhkTypes)) {
					foreach ($bhkTypes as $bhkType) {
						$query->orWhere('bhk_types', 'like', '%' . $bhkType . '%');
					}
				}
			});

			if (isset($projectStatus)) {
				$query->where(function ($query) use ($projectStatus) {
					foreach ($projectStatus as $status) {
						$formattedStatus = strtolower(str_replace(' ', '_', $status));
						$query->orWhere('delivery_status', 'like', '%' . $formattedStatus . '%');
					}
				});
			}
            if (isset($budgets) && is_array($budgets) && count($budgets) === 2) {
                $minPrice = floatval($budgets[0]); // Ensure numeric value
                $maxPrice = floatval($budgets[1]); // Ensure numeric value
                $query->whereBetween('min_price', [$minPrice, $maxPrice]);
            }


			$totalCount = $query->count();
			$projects = $query->paginate($perPage, ['*'], 'page', $pageId);

			return response()->json([
				'data' => [
					'data' => ProjectResource::collection($projects),
					'total_count' => $totalCount,
					'last_page' => $projects->lastPage(),
				],
				'status' => true
			], 200);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}

	public function getProjects(Request $request)
	{
		try {
			$pageId = $request->page ?? 1;
			$perPage = 10;

			$keyword = $request->keyword;
			$filter = @$request->filter;
			$cities = @$filter['cities'];
			 
			$bhkTypes  = [];
			$bhkTypes = @$filter['bhkTypes'];
			$projectStatus = @$filter['possessions'];
			$budgets = @$filter['budgets'];

			$query = Project::where('status', true)->with('highlights')->orderBy('created_at', 'ASC');
			if (isset($keyword)) {
				$query->where('name', 'like', '%' . $keyword . '%');
			}
			$query->where(function ($query) use ($cities) {
				if (isset($cities)) {
					foreach ($cities as $city) {
						$query->orWhere('city', $city);
					}
				}
			});
			$query->where(function ($query) use ($bhkTypes) {
				if (isset($bhkTypes)) {
					foreach ($bhkTypes as $bhkType) {
						$query->orWhere('bhk_types', 'like', '%' . $bhkType . '%');
					}
				}
			});

			if (isset($projectStatus)) {
				$query->where(function ($query) use ($projectStatus) {
					foreach ($projectStatus as $status) {
						$formattedStatus = strtolower(str_replace(' ', '_', $status));
						$query->orWhere('delivery_status', 'like', '%' . $formattedStatus . '%');
					}
				});
			}
            if (isset($budgets) && is_array($budgets) && count($budgets) === 2) {
                $minPrice = floatval($budgets[0]); // Ensure numeric value
                $maxPrice = floatval($budgets[1]); // Ensure numeric value
                $query->whereBetween('min_price', [$minPrice, $maxPrice]);
            }


			$totalCount = $query->count();
			$projects = $query->paginate($perPage, ['*'], 'page', $pageId);

			return response()->json([
				'data' => [
					'data' => ProjectResource::collection($projects),
					'total_count' => $totalCount,
					'last_page' => $projects->lastPage(),
				],
				'status' => true
			], 200);

			// return response()->json([
			// 'data' => [
			// 'data' => ProjectResource::collection($projects),
			// 'last_page' => $projects->lastPage(),
			// ], 
			// 'status' => true
			// ], 200);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}

	public function getProjectDetail($slug)
	{
		try {
			// Assuming $id is obtained and decoded correctly
			$project = Project::where('status', true)->with('locations', 'highlights', 'floorPlans', 'possessions', 'amenities', 'devBackgrounds', 'pricings', 'advices', 'files')->where('slug', $slug)->firstOrFail();

			//increase the api hits
			$project->no_of_visits += 1;
			$project->save();

			$prependBaseUrl = function ($filePath) {
				return url('storage/' . $filePath);
			};

			$decodedFiles = json_decode($project->files->files, true);

			$floorPlanFiles = json_decode($project->floorPlans->floor_plans_data, true);
			if (!empty($floorPlanFiles) && count($floorPlanFiles) > 0) {
				foreach ($floorPlanFiles as $key => $floorPlanFile) {
					$floorPlanFiles[$key]['image'] = $prependBaseUrl($floorPlanFile['image']);
				}
			}
			$project->faqs_data = json_decode($project->faqs_data, true);
			$project->floorPlans->floor_plans_data = $floorPlanFiles;

			if (isset($project->logo)) {
				$project->logo = $prependBaseUrl($project->logo);
			}

			if (isset($project->featured_image)) {
				$project->featured_image = $prependBaseUrl($project->featured_image);
			}
			if (isset($project->delivery_status)) {
				$project->delivery_status = deliveryStatus($project->delivery_status);
			}

			foreach ($decodedFiles as $key => &$fileList) {
				$fileList = $prependBaseUrl($fileList);
			}
			unset($project->files);
			$project->files = $decodedFiles;
			// $project->similarProjects = Project::orderBy('id','DESC')->where('city',$project->city)->select('id','bhk_types','delivery_status', 'name','logo','slug','location','min_price','max_price')->take(10)->get();
			$project->similarProjects = Project::orderBy('id', 'DESC')
				->where('city', $project->city)
				->where('status', true)
				->where('id', '!=', $project->id) // Exclude the current project
				->select('id', 'bhk_types', 'delivery_status', 'name', 'logo', 'slug', 'location', 'min_price', 'max_price')
				->take(10)
				->get();

			$project->makeHidden(['compare_data']);
			if (!empty($project->similarProjects)) {
				foreach ($project->similarProjects as $key => $similar) {
					$project->similarProjects[$key]['logo'] = $prependBaseUrl($similar->logo);
				}
			}
			return response()->json([
				'message' => 'Data fetched successfully.',
				'status'  => true,
				'data' => $project
			], 200);
		} catch (ModelNotFoundException $e) {
			Log::error('Model not found: ' . $e->getMessage());
			return response()->json([
				'message' => 'Model not found.',
				'status' => false
			], 404);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error',
				'status' => false
			], 500);
		}
	}
	public function searchProjects(Request $request)
	{
		$request->validate([
			'keyword' => 'required|string',
		]);

		$keyword = $request->input('keyword');
		$location = $request->input('location');

		preg_match_all('/\d+\s*bhk|\S+/', strtolower(trim($keyword)), $matches);

		// Clean and reformat "bhk" terms to remove spaces
		$keywords = array_map(function ($term) {
			return preg_replace('/\s+/', '', $term); // Convert "2 bhk" to "2bhk"
		}, $matches[0]);

		// Re-index array and remove any empty values
		$keywords = array_values(array_filter($keywords));

		// List of common prepositions and articles to exclude
		$exclusions = [
			'in',
			'on',
			'at',
			'by',
			'with',
			'about',
			'against',
			'between',
			'into',
			'through',
			'during',
			'before',
			'after',
			'above',
			'below',
			'to',
			'from',
			'up',
			'down',
			'over',
			'under',
			'again',
			'further',
			'then',
			'once',
			'here',
			'there',
			'when',
			'where',
			'why',
			'how',
			'all',
			'any',
			'both',
			'each',
			'few',
			'more',
			'most',
			'other',
			'some',
			'such',
			'no',
			'nor',
			'not',
			'only',
			'own',
			'same',
			'so',
			'than',
			'too',
			'very',
			'can',
			'will',
			'just',
			'don',
			'should',
			'now',
			'and',
			'or',
			'but',
			'if',
			'because',
			'as',
			'until',
			'while',
			'of',
			'the',
			'a',
			'an'
		];

		// Filter out prepositions and articles from the keywords
		$keywords = array_filter($keywords, function ($word) use ($exclusions) {
			return !in_array(strtolower($word), $exclusions);
		});

		// Re-index array
		$keywords = array_values($keywords);

		$results = [
			'projects' => collect(),   // Initialize as empty collections
			'locality' => collect(),
			'bhk_types' => collect(),
		];

		if (!empty($keywords)) {

			// Search for projects by name
			$results['projects'] = Project::where('status', true)
				->where(function ($query) use ($keywords) {
					foreach ($keywords as $keyword) {
						$query->orWhere('name', 'LIKE', '%' . $keyword . '%');
					}
				})
				->when($location, function ($query) use ($location) {
					return $query->where('city', 'LIKE', '%' . $location . '%');
				})
				->select('id', 'name', 'slug')
				->get();

			// Search for localities by city
			$results['locality'] = Project::where('status', true)->where(function ($query) use ($keywords) {
				foreach ($keywords as $keyword) {
					$query->orWhere('city', 'LIKE', '%' . $keyword . '%');
				}
			})->pluck('city')->unique()->values()->all();

			// Search for projects by BHK types
			foreach ($keywords as $keyword) {
				// Check if the keyword contains 'bhk' (case insensitive)
				if (stripos($keyword, 'bhk') !== false) {
					$results['bhk_types'][] = strtoupper(preg_replace('/(\d+)(bhk)/i', '$1 $2', $keyword)); // Push keyword into bhk_types array
				}
			}
		}

		return response()->json([
			'message' => 'Data fetched successfully.',
			'status' => true,
			'data' => $results
		], 200);
	}

	public function getCompareListing(Request $request)
	{
		try {
			$projects = Project::where('status', true)->where('city', $city)->where('price', $min_price)->get();


			return response()->json([
				'message' => 'Data Fetched successfully.',
				'status' => true,
				'data' => [
					'token' => $token
				]
			], 200);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error- ' . $e,
				'status' => false
			], 500);
		}
	}


	public function mostSearchedProjects()
	{
		//$projects = Project::where('status',true)->where('city',$city)->orderBy('no_of_visits','DESC')->take(15)->get();

		$cities = Project::where('status', true)->select('city')->distinct()->get();

		$projects = [];

		foreach ($cities as $city) {
			$cityProjects = Project::where('status', true)->where('city', $city->city)
				->orderBy('no_of_visits', 'DESC')
				->take(5)
				->get();

			$projects = array_merge($projects, $cityProjects->toArray());
		}
		foreach ($projects as &$project) {

			if (isset($project['logo'])) {

				$project['logo'] = url('storage/' . $project['logo']);
				//dd($project['logo']);
			}
		}

		return response()->json([
			'message' => 'Data fetched successfully.',
			'status'  => true,
			'data'    => $projects
		], 200);
	}

	public function sendOtp(Request $request)
	{
		try {
			$request->validate([
				'phone_number' => 'required'
			]);

			$otp = mt_rand(100000, 999999);
			$phoneNumber = $request->input('phone_number');

			//send otp function 
			$message = "Hello User,\nYour OTP for registration is: $otp.\nExpires within 5 minutes. Do not share this OTP.\nThank you,\nWhite Hat Realty";

			$response = $this->vonageService->sendSms($phoneNumber, $message);
			$responseData = json_decode($response, true);

			$user = (User::where('phone_number', $phoneNumber)->first()) ? (User::where('phone_number', $phoneNumber)->first()) : new User;
			$user->phone_number = $phoneNumber;
			$user->otp = $otp;
			$user->name = 'guest';
			$user->email = 'guest@guest.com' . time();
			$user->password = 'guest@guest.com';
			$user->role_id = 2;
			$user->save();

			return response()->json([
				'message' => 'OTP sent successfully.',
				'status' => true,
				'data' => base64_encode($user->id)
			], 200);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error- ' . $e,
				'status' => false
			], 500);
		}
	}

	public function verifyOtp(Request $request)
	{
		try {
			// dd($request->all());
			$request->validate([
				'otp' => 'required',
				'id'  => 'required'
			]);
			$user = User::findOrFail(base64_decode($request->id));
			if ($user->otp === $request->otp) {
				$user->otp_verified_at = now();
				$user->update();
				$token = $user->createToken('otp-token')->plainTextToken;
				return response()->json([
					'message' => 'OTP verified successfully.',
					'status' => true,
					'data' => [
						'token' => $token
					]
				], 200);
			} else {
				return response()->json([
					'message' => 'Entered OTP is not correct.',
					'status' => false
				], 200);
			}
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error- ' . $e,
				'status' => false
			], 500);
		}
	}

	public function getCompareData(Request $request)
	{
		try {
			$slugs = [$request->project1, $request->project2];

			$projects = Project::where('status', true)->whereIn('slug', $slugs)->pluck('compare_data', 'name');

			foreach ($projects as $key => $project) {
				$projects[$key] = json_decode($project);
			}
			return response()->json([
				'message' => 'data fetched successfully.',
				'status' => true,
				'data' => $projects
			], 200);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error- ' . $e,
				'status' => false
			], 500);
		}
	}

	public function getCity(Request $request){
		try {
			$cities = Project::where('status', true)->distinct()->orderBy('city', 'ASC')->pluck('city');
			return response()->json([
				'message' => 'data fetched successfully.',
				'status' => true,
				'data' => $cities 
			], 200);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error- ' . $e,
				'status' => false
			], 500);
		}
	}

	//get homepage compare data listing
	public function compareListing()
	{
		try {
			$city = (request()->city === null) ? request()->city : 'noida';
			// Fetch projects for the given city
			$cityProjects = Project::where('status', true)->where('city', $city)->orderBy('min_price', 'DESC')->get();

			// If the number of projects in the city is 10 or more, return them
			if ($cityProjects->count() >= 10) {
				$projects = $cityProjects->take(10);
			} else {
				// Otherwise, get remaining projects to make up the difference
				$remainingCount = 10 - $cityProjects->count();
				$remainingProjects = Project::where('status', true)->where('city', '!=', $city)
					->orderBy('min_price', 'DESC')
					->take($remainingCount)
					->get();

				// Merge the city projects with the remaining projects
				$projects = $cityProjects->merge($remainingProjects);
			}

			// Chunk projects into pairs of 2
			$chunkedProjects = $projects->chunk(2);

			// Prepare data for the response
			$responseData = [];
			foreach ($chunkedProjects as $set) {
				$responseData[] = CompareListingResource::collection($set);
			}

			return response()->json([
				'data' => $responseData,
				'status' => true,
				'message' => 'data fetched successfully.'
			]);
		} catch (\Exception $e) {
			Log::error('Error fetching: ' . $e->getMessage());
			return response()->json([
				'message' => 'Internal Server Error- ' . $e,
				'status' => false
			], 500);
		}
	}
	//for search the blogs by title
	public function searchBlog(Request $request)
	{
		try {
			// Fetch the title from the request
			$title = $request->input('title');

			// Query the blogs table based on the title input
			$blogs = Blog::where('title', 'LIKE', '%' . $title . '%')->select('title', 'slug')->get(); // Fetch only title and slug

			// Check if any blogs were found
			if ($blogs->isEmpty()) {
				return response()->json([
					'data' => [],
					'status' => false,
					'message' => 'No blogs found with the provided title.'
				], 200);
			}

			// Return the result if blogs are found
			return response()->json([
				'data' => $blogs,
				'status' => true,
				'message' => 'Blogs fetched successfully.'
			]);
		} catch (\Exception $e) {
			// Catch the exception and return the error message
			\Log::error('Error fetching blogs: ' . $e->getMessage());

			return response()->json([
				'message' => 'Internal Server Error: ' . $e->getMessage(),
				'status' => false
			], 500);
		}
	}


	public function sendSmsonPhone(Request $req)
	{
		$url = 'https://www.mysmsapp.in/sms/send?option=simple';

		$data = [
			'apikey' => '672df5f396826',   // Replace with your actual API key
			'senderid' => 'Pguide', // Replace with your sender ID
			'mobilenumbers' => '9400365935',    // Replace with the recipient phone number
			'text' => 'Hello'              // The message text
		];

		$options = [
			'http' => [
				'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data),
			],
		];

		$context  = stream_context_create($options);
		$response = file_get_contents($url, false, $context);

		if ($response === FALSE) {
			die('Error');
		}

		echo $response;
	}

	public function UserSubscribers(Request $request){
		// Define validation rules 
		$rules = [
			'email' => 'required|email',
		];

		$validator = Validator::make($request->all(), $rules);

		// Check if validation fails
		if ($validator->fails()) {
			return response()->json([
				'message' => 'Validation Errors.',
				'status'  => false,
				'data'    => $validator->errors(),
			], 422); 
		}

		try {
			// Create the subscriber
			if(NewsletterSubscriber::where(['email' => $request->email])->first() !== null){
				$message = "You have already subscribed.";
			}else{
				NewsletterSubscriber::create(['email' => $request->email]);
				$message = 'Your email has been saved for future notifications.';
			}
			return response()->json([
				'message' => $message,
				'status'  => true,
				'data'    => null
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'message' => 'An error occurred while saving your email.',
				'status'  => false,
				'data'    => null,
			], 500);
		}
	}
	
	public function getGraphApiData(Request $request)
	{
		try {
			$response = $this->facebookData();

			return  response()->json([
				'message' => 'data fetched successfully.',
				'status'  => true,
				'data'    => $response
			]);
		} catch (\Exception $e) {
			return response()->json([
				'errors' => $e->errors(),
				'status' => false,
				'message' => 'Server Error',
			], 422);
		}
	}

	private function facebookData()
	{
		try {
			$obj = new SocialMediaService;
			$result = $obj->fetchData();
			return $result->original->posts->data;
		} catch (\Exception $e) {
			return response()->json([
				'errors' => $e->errors(),
				'status' => false,
				'message' => 'Server Error',
			], 422);
		}
	}



	public function getFiltersData(Request $request)
	{
		try {
			$filtersData = [];
			$filtersData['budgets']['min_price'] = Project::min('min_price');
			$filtersData['budgets']['max_price'] = Project::max('max_price');

			//cities
			$filtersData['cities'] = Project::distinct()->pluck('city');

			//possessions
			$filtersData['possessions'] = Project::distinct()->pluck('delivery_status');
			$filtersData['possessions'] = $filtersData['possessions']->map(function ($status) {
				return deliveryStatus($status);
			});

			// bhk_types
			$filtersData['bhkTypes'] = array('2 BHK', '3 BHK', '4 BHK', 'More');
			
			$filtersData['sortingType'] = array('Popularity', 'Price Low to High', 'Price High to Low', 'Newest First');


			return response()->json([
				'message' => 'Fetched data.',
				'status'  => true,
				'data'    => $filtersData
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'errors' => $e->errors(),
				'status' => false,
				'message' => 'Server Error',
			], 422);
		}
	}
}
