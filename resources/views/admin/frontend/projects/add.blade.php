@extends('layouts.admin-app')
@section('title', $title)
@section('customCss')
<link rel="stylesheet" href="{{url('assets/customs/css/projects.css')}}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            {!! $breadcrumbHtml !!}
            <div class="contentCard projects">
				<div class="card">
					<div class="card-header">
						<b>Basic Information</b>
					</div>
					
					<div class="card-body">
						 <form method="POST" action="{{route('projects.store')}}" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Project Name</span></label>
									<input class="form-control input @error('name') is-invalid @enderror " type="text" placeholder="Enter Project Name" value="{{old('name')}}" name="name" required> 
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Owner Name</label>
									<input class="form-control input  @error('owner_name') is-invalid @enderror" type="text" name="owner_name" value="{{old('owner_name')}}" placeholder="Enter Owner Name" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Project Status</label>
									<select placeholder="Select Project Status" name="delivery_status" class="form-control input select2 required">
										<option value="new_launch"> New launch </option>
										<option value="ready_to_move"> Ready To Move </option>
										<option value="under_construction"> Under Construction </option>
										<option value="possession_within_year"> Possession Within a Year </option>
									</select>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">RERA Number</label>
									<input class="form-control input @error('rera_no') is-invalid @enderror" type="text" placeholder="Enter RERA Number" value="{{old('rera_no')}}" name="rera_no" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Minimum Price <span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('min_price') is-invalid @enderror" type="text" placeholder="Enter Minimum Price Per sq ft" value="{{old('min_price')}}" name="min_price" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Maximum Price <span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('max_price') is-invalid @enderror" type="text" placeholder="Enter Maximum Price Per sq ft" value="{{old('max_price')}}" name="max_price" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4"> 
									<label for="name">Land Area <span class="text-danger">(In Acres only*)</span></label>
									<input class="form-control input @error('land_area') is-invalid @enderror" type="text" placeholder="Enter Land Area" value="{{old('land_area')}}" name="land_area" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Location</label>
									<input class="form-control input @error('location') is-invalid @enderror" type="text" placeholder="Enter Project Location" value="{{old('location')}}" name="location" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="city">City</label>
									<input class="form-control input @error('city') is-invalid @enderror" type="text" placeholder="Enter Project City" value="{{old('city')}}" name="city" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">BHK Types</label>
									<input class="form-control input @error('bhk_types') is-invalid @enderror" type="text" placeholder="Enter BHK Types" value="{{old('bhk_types')}}" name="bhk_types" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Number of Towers <span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('towers') is-invalid @enderror" type="text" placeholder="Enter Number of Towers" value="{{old('towers')}}" name="towers" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Number of Parking<span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('parking') is-invalid @enderror" type="text" placeholder="Enter Parking Area" value="{{old('parking')}}" name="parking" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Density Unit Per Acre <span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('density_unit_per_area') is-invalid @enderror" type="text" placeholder="Enter Density Unit Per Acre" value="{{old('density_unit_per_area')}}" name="density_unit_per_area" required>  
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Number of Apartments <span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('no_of_apartments') is-invalid @enderror" type="text" placeholder="Enter Number of Apartments" value="{{old('no_of_apartments')}}" name="no_of_apartments" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Apartment to Lift Ratio <span class="text-danger">(Numeric Only*)</span></label> 
									<input class="form-control input @error('lift_ratio') is-invalid @enderror" type="text" placeholder="Enter Lift Ratio" value="{{old('lift_ratio')}}" name="lift_ratio" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4"> 
									<label for="name">Launch Date </label>
									<input class="form-control input @error('launch_date') is-invalid @enderror" type="text" placeholder="Enter Launch Date" value="{{old('launch_date')}}" name="launch_date" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Possession as Per RERA Date</label>
									<input class="form-control input @error('possession_rera_date') is-invalid @enderror" type="text" placeholder="Enter Possession as per RERA Date" value="{{old('possession_rera_date')}}" name="possession_rera_date" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">SEO Title</label>
									<input class="form-control input @error('title') is-invalid @enderror" type="text" placeholder="Enter Project SEO Title" value="{{old('title')}}" name="title" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Keywords</label>
									<input class="form-control input @error('keywords') is-invalid @enderror" type="text" placeholder="Enter Project Keywords" value="{{old('keywords')}}" name="keywords" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">YouTube Link <span class="text-danger">(URL only*)</span></label>
									<input class="form-control input @error('youtube_link') is-invalid @enderror" type="url" placeholder="Enter Project YouTube Link" value="{{old('youtube_link')}}" name="youtube_link" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Meta Description</label>
									<input class="form-control input @error('meta_description') is-invalid @enderror" type="text" placeholder="Enter Project Meta Description" value="{{old('meta_description')}}" name="meta_description" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Canonical Link</label>
									<input class="form-control input @error('canonical_link') is-invalid @enderror" type="text" placeholder="Enter Project Canonical Link" value="{{@old('canonical_link')}}" name="canonical_link" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Image Alt Tag</label>
									<input class="form-control input @error('image_alt_tag') is-invalid @enderror" type="text" placeholder="Enter Project Image Alt Tag" value="{{@old('image_alt_tag')}}" name="image_alt_tag" required>
								</div>
							    
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Developer Experience <span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('experience') is-invalid @enderror" type="text" placeholder="Enter Developer Experience" value="{{old('experience')}}" name="experience" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Projects Delivered <span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('projects_delivered') is-invalid @enderror" type="text" placeholder="Enter Projects Delivered" value="{{old('projects_delivered')}}" name="projects_delivered" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Ongoing Projects <span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('ongoing_projects') is-invalid @enderror" type="text" placeholder="Enter Ongoing Projects" value="{{old('ongoing_projects')}}" name="ongoing_projects" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Timely Project Delivered Ratio</span></label>
									<input class="form-control input @error('area_built') is-invalid @enderror" type="text" placeholder="Enter Timely Project Delivered Ratio" value="{{old('area_built')}}" name="area_built" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Initial BSP for Super Area <span class="text-danger">(Numeric only*)  </span></label>
									<input class="form-control input @error('initial_bsp_super_area') is-invalid @enderror" type="text" placeholder="Enter Initial BSP for Super Area" value="{{@old('initial_bsp_super_area')}}" name="initial_bsp_super_area" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">BSP for Super Area <span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('bsp_super_area') is-invalid @enderror" type="text" placeholder="Enter BSP for Super Area" value="{{@old('bsp_super_area')}}" name="bsp_super_area" required>
								</div>
								<div class="col-12"></div>
								<div class="col-sm-12 col-lg-6 d-flex mb-4"> 
									<div class="form-group fileInput mr-2">
										<label for="thumbnail">Project Logo:</label> 
										<input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" onchange="previewImage(this, '#previewLogo')" placeholder="Project Logo" id="logo" required>	
									</div>
									 <div class="fileInput">
										<img src="/../../assets/images/NA.webp" alt="photo"  id="previewLogo"> 
									</div>
								</div>
								<div class="col-sm-12 col-lg-6 d-flex mb-4">
									<div class="form-group fileInput mr-2">
										<label for="FeaturedImage">Featured Image:</label>
										<input type="file" class="form-control  @error('featured_image') is-invalid @enderror" name="featured_image" onchange="previewImage(this, '#previewFeaturedImage')" placeholder="featuredImage" id="featuredImage" required>	
									</div>
									 <div class="fileInput">
										<img src="/../../assets/images/NA.webp" alt="photo"  id="previewFeaturedImage">  
									</div>
								</div>
								
								<div class="col-12">
								<h5>Location Details</h5>
								</div>
								<hr/>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="metro">Nearest Metro Station </label>
									<input class="form-control input @error('compare_data[locations][nearest_metro]') is-invalid @enderror" type="text" placeholder="Enter Nearest Metro Station" value="{{@old('compare_data')['locations']['nearest_metro']}}" name="compare_data[locations][nearest_metro]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="metro">Nearest Railway Station </label>
									<input class="form-control input @error('compare_data[locations][nearest_railway]') is-invalid @enderror" type="text" placeholder="Enter Nearest Railway Station" value="{{@old('compare_data')['locations']['nearest_railway']}}" name="compare_data[locations][nearest_railway]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="metro">Nearest Airport </label>
									<input class="form-control input @error('compare_data[locations][nearest_airport]') is-invalid @enderror" type="text" placeholder="Enter Nearest Airport" value="{{@old('compare_data')['locations']['nearest_airport']}}" name="compare_data[locations][nearest_airport]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="metro">Hospitals in 10 Kms Radius (3-4 options)</label>
									<input class="form-control input @error('compare_data[locations][nearest_hospitals]') is-invalid @enderror" type="text" placeholder="Enter Nearest Hospitals" value="{{@old('compare_data')['locations']['nearest_hospitals']}}" name="compare_data[locations][nearest_hospitals]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="metro">Schools in 10 Kms Radius (3-4 options)</label>
									<input class="form-control input @error('compare_data[locations][nearest_schools]') is-invalid @enderror" type="text" placeholder="Enter Nearest Schools" value="{{@old('compare_data')['locations']['nearest_schools']}}" name="compare_data[locations][nearest_schools]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="road">Road Connectivity</label>
									<input class="form-control input @error('compare_data[locations][road_connectivity]') is-invalid @enderror" type="text" placeholder="Road Connectivity" value="{{@old('compare_data')['locations']['road_connectivity']}}" name="compare_data[locations][road_connectivity]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="road">Other Nearby Facilities</label>
									<input class="form-control input @error('compare_data[locations][other_nearby_facilities]') is-invalid @enderror" type="text" placeholder="Other Nearby Facilities" value="{{@old('compare_data')['locations']['other_nearby_facilities']}}" name="compare_data[locations][other_nearby_facilities]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="locations_descp">Location Description:</label>
										<textarea name="locations_descp" id="locations_descp"  class="summernote" required>
										{{@old('locations_descp')}}
										</textarea>
									</div>
								</div>
								<div class="col-sm-12 col-lg-6 mt-5">
									<div class="form-group fileInput">
										<label for="FeaturedImage">Location files: <span class="text-danger">(Video*)</span></label> 
										<input type="file" class="form-control  @error("media[locations]") is-invalid @enderror" name="media[locations]" required>	
									</div>
								</div>
								<div class="col-12">
								<h5>Project Highlights details</h5>
								</div>
								<hr/>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="landsize">Land Size in Acres </label>
									<input class="form-control input @error('compare_data[highlights][land_size_in_acres]') is-invalid @enderror" type="text" placeholder="Enter Land Size in Acres" value="{{@old('compare_data')['highlights']['land_size_in_acres']}}" name="compare_data[highlights][land_size_in_acres]" required> 
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="noofphases">Total Number of Phases </label>
									<input class="form-control input @error('compare_data[highlights][total_number_of_phases]') is-invalid @enderror" type="text" placeholder="Enter Total Number of Phases" value="{{@old('compare_data')['highlights']['total_number_of_phases']}}" name="compare_data[highlights][total_number_of_phases]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="tower">Number of Towers (According to phases if phases are there)</label>
									<input class="form-control input @error('compare_data[highlights][total_number_of_tower]') is-invalid @enderror" type="text" placeholder="Enter Number of Tower" value="{{@old('compare_data')['highlights']['total_number_of_tower']}}" name="compare_data[highlights][total_number_of_tower]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="noofunits">Total Number of Units</label>
									<input class="form-control input @error('compare_data[highlights][total_number_of_unit]') is-invalid @enderror" type="text" placeholder="Enter Total Number of Units" value="{{@old('compare_data')['highlights']['total_number_of_unit']}}" name="compare_data[highlights][total_number_of_unit]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="accommodations">Accommodations(In BHK)</label>
									<input class="form-control input @error('compare_data[highlights][accommodations_in_BHK]') is-invalid @enderror" type="text" placeholder="Enter Accommodations In BHK" value="{{@old('compare_data')['highlights']['accommodations_in_BHK']}}" name="compare_data[highlights][accommodations_in_BHK]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="construction">Project Construction (Mivan or Bricks Based)</label>
									<input class="form-control input @error('compare_data[highlights][project_construction]') is-invalid @enderror" type="text" placeholder="Enter Project Construction (Mivan or Bricks Based)" value="{{@old('compare_data')['highlights']['project_construction']}}" name="compare_data[highlights][project_construction]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="towerheight">Tower Height (UpTo)</label>
									<input class="form-control input @error('compare_data[highlights][tower_height_upto]') is-invalid @enderror" type="text" placeholder="Enter Average Tower Height" value="{{@old('compare_data')['highlights']['tower_height_upto']}}" name="compare_data[highlights][tower_height_upto]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="podiumbased">Podium Based Structure (Yes or No)</label>
									<input class="form-control input @error('compare_data[highlights][podium_based_structure]') is-invalid @enderror" type="text" placeholder="Enter Project is Podium Based or Not" value="{{@old('compare_data')['highlights']['podium_based_structure']}}" name="compare_data[highlights][podium_based_structure]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="towerheight">Level of Basement</label>
									<input class="form-control input @error('compare_data[highlights][level_of_basement]') is-invalid @enderror" type="text" placeholder="Enter Level of Basement" value="{{@old('compare_data')['highlights']['level_of_basement']}}" name="compare_data[highlights][level_of_basement]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="lift">Number of Lift According to Tower</label>
									<input class="form-control input @error('compare_data[highlights][number_of_lift_according_to_tower]') is-invalid @enderror" type="text" placeholder="Enter Number of Lifts According to Tower" value="{{@old('compare_data')['highlights']['number_of_lift_according_to_tower']}}" name="compare_data[highlights][number_of_lift_according_to_tower]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="lifttoapartment">Lift to Apartment Ratio (Lowest-Highest)</label>
									<input class="form-control input @error('compare_data[highlights][lift_to_apartment_ratio]') is-invalid @enderror" type="text" placeholder="Enter Lift to Apartment Ratio" value="{{@old('compare_data')['highlights']['lift_to_apartment_ratio']}}" name="compare_data[highlights][lift_to_apartment_ratio]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="noofparking">Total Number of Parking</label>
									<input class="form-control input @error('compare_data[highlights][total_number_of_parking]') is-invalid @enderror" type="text" placeholder="Enter Total Number Of Parking" value="{{@old('compare_data')['highlights']['total_number_of_parking']}}" name="compare_data[highlights][total_number_of_parking]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="parkingperapartment">Average Number of Parking Per Apartments</label>
									<input class="form-control input @error('compare_data[highlights][average_number_of_parking_per_apartments]') is-invalid @enderror" type="text" placeholder="Enter Average Number of Parking per Apartments" value="{{@old('compare_data')['highlights']['average_number_of_parking_per_apartments']}}" name="compare_data[highlights][average_number_of_parking_per_apartments]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="apartmentperfloor">Apartment Per Floor Tower Wise</label>
									<input class="form-control input @error('compare_data[highlights][apartment_per_floor_tower_wise]') is-invalid @enderror" type="text" placeholder="Enter Apartment Per Floor Tower Wise" value="{{@old('compare_data')['highlights']['apartment_per_floor_tower_wise']}}" name="compare_data[highlights][apartment_per_floor_tower_wise]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="apartmentsacres">Apartments Per Acres</label>
									<input class="form-control input @error('compare_data[highlights][apartments_per_acres]') is-invalid @enderror" type="text" placeholder="Enter Apartments Per Acres" value="{{@old('compare_data')['highlights']['apartments_per_acres']}}" name="compare_data[highlights][apartments_per_acres]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="openspace">Open Space in Percentage (including green area)</label>
									<input class="form-control input @error('compare_data[highlights][open_space_including_green_space]') is-invalid @enderror" type="text" placeholder="Enter Open Space in Percentage" value="{{@old('compare_data')['highlights']['open_space_including_green_space']}}" name="compare_data[highlights][open_space_including_green_space]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="clubarea">Club Area in Square Feet</label>
									<input class="form-control input @error('compare_data[highlights][club_area_in_sqft]') is-invalid @enderror" type="text" placeholder="Enter Club Area in Square Feet" value="{{@old('compare_data')['highlights']['club_area_in_sqft']}}" name="compare_data[highlights][club_area_in_sqft]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="landstatus">Land Status (Fully paid or Partial Paid)</label>
									<input class="form-control input @error('compare_data[highlights][land_status]') is-invalid @enderror" type="text" placeholder="Enter Open Space in Percentage" value="{{@old('compare_data')['highlights']['land_status']}}" name="compare_data[highlights][land_status]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="projectstatus">Project Status</label>
									<input class="form-control input @error('compare_data[highlights][project_status]') is-invalid @enderror" type="text" placeholder="Enter Project Status" value="{{@old('compare_data')['highlights']['project_status']}}" name="compare_data[highlights][project_status]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="homeloan">Banks Name for Home Loan</label> 
									<input class="form-control input @error('compare_data[highlights][home_loan_facility]') is-invalid @enderror" type="text" placeholder="Enter Two or Three Bank Name" value="{{@old('compare_data')['highlights']['home_loan_facility']}}" name="compare_data[highlights][home_loan_facility]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="highlights_descp">Highlights Description:</label>
										<textarea name="highlights_descp" id="highlights_descp" class="summernote" required>
										{{@old('highlights_descp')}}
										</textarea>
									</div>
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-5">
									<div class="form-group fileInput">
										<label for="FeaturedImage">Highlights files:  <span class="text-danger">(1 Images only*)</span></label>
										<input type="file" class="form-control  @error("media[highlights]") is-invalid @enderror" name="media[highlights]" required>	
									</div>
								</div>
								<div class="col-12 mt-5">
									<h5>
										BHK Plans
									</h5>
								</div>
								<div class="floors row p-3">
									@if(!empty(old('floor_plans')) && count(old('floor_plans'))>0)
										@foreach(old('floor_plans') as $key => $floorPlan)
									<div class="col-sm-12 col-lg-12 mt-2 pdfloorPlans" style="padding:0 30px">
										<div class="row pt-5 pb-5" style="background:#1b577733">
											<div class="col">
												<label for="title">Title:</label>
												<input value="{{$floorPlan['title']}}" name="floor_plans[{{$key}}][title]" type="text" class="form-control" required>
											</div>
											<div class="col">
												<label for="super_area">Super Area:</label>
												<input  value="{{$floorPlan['super_area']}}"  name="floor_plans[{{$key}}][super_area]" type="text" class="form-control" required>
											</div>
											<div class="col">
												<label for="carpet_area">Carpet Area:</label>
												<input  value="{{$floorPlan['carpet_area']}}"  name="floor_plans[{{$key}}][carpet_area]" type="text" class="form-control" required>
											</div>
											<div class="col">
												<label for="built_area">Builtup Area:</label>
												<input  value="{{$floorPlan['built_area']}}"  name="floor_plans[{{$key}}][built_area]" type="text" class="form-control" required>
											</div>
											<div class="col">
												<label for="balcony_area">Balcony Area:</label>
												<input value="{{$floorPlan['balcony_area']}}"  name="floor_plans[{{$key}}][balcony_area]" type="text" class="form-control" required>
											</div>
											<div class="col">
												<label for="feature_image">Image:</label>
												<input name="floor_plans[{{$key}}][feature_image]" type="file" class="form-control" required>
											</div>
										</div>
										<span class="bg-warning plusBtn">
											<i class="fa fa-plus"></i>
										</span>
									</div>
									@endforeach
									@else
										<div class="col-sm-12 col-lg-12 mt-2 pdfloorPlans" style="padding:0 30px">
									<div class="row pt-5 pb-5" style="background:#1b577733">
											<div class="col">
												<label for="title">Title:</label>
												<input name="floor_plans[0][title]" type="text" class="form-control" required>
											</div>
											<div class="col">
												<label for="super_area">Super Area:</label>
												<input name="floor_plans[0][super_area]" type="text" class="form-control" required>
											</div>
											<div class="col">
												<label for="carpet_area">Carpet Area:</label>
												<input name="floor_plans[0][carpet_area]" type="text" class="form-control" required>
											</div>
											<div class="col">
												<label for="built_area">Builtup Area:</label>
												<input name="floor_plans[0][built_area]" type="text" class="form-control" required>
											</div>
											<div class="col">
												<label for="balcony_area">Balcony Area:</label>
												<input name="floor_plans[0][balcony_area]" type="text" class="form-control" required>
											</div>
											<div class="col">
												<label for="feature_image">Image:</label>
												<input name="floor_plans[0][feature_image]" type="file" class="form-control" required>
											</div>
										</div>
										<span class="bg-warning plusBtn">
											<i class="fa fa-plus"></i>
										</span>
										</div>
									@endif
								</div>
                                <div class="col-12">
								<h5>Floor Plans Details</h5>
								</div>
								<hr/>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="superarea">Super Area of All Varients</label>
									<input class="form-control input @error('compare_data[floorPlans][super_area_of_all_variants]') is-invalid @enderror" type="text" placeholder="Enter Super Area of All Varients" value="{{@old('compare_data')['floorPlans']['super_area_of_all_variants']}}" name="compare_data[floorPlans][super_area_of_all_variants]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="carpetarea">RERA Carpet Area for All Variants</label>
									<input class="form-control input @error('compare_data[floorPlans][carpet_area_of_all_variants]') is-invalid @enderror" type="text" placeholder="Enter Super Area of All Varients" value="{{@old('compare_data')['floorPlans']['carpet_area_of_all_variants']}}" name="compare_data[floorPlans][carpet_area_of_all_variants]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="floorplans">Floor Plans</label>
									<input class="form-control input @error('compare_data[floorPlans][floor_plans]') is-invalid @enderror" type="text" placeholder="Enter Floor Plans" value="{{@old('compare_data')['floorPlans']['floor_plans']}}" name="compare_data[floorPlans][floor_plans]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="difference">Difference between Super and Carpet Area in percentage</label>
									<input class="form-control input @error('compare_data[floorPlans][difference_between_super_and_carpet_area_in_percentage]') is-invalid @enderror" type="text" placeholder="Difference between super and carpet area in percentage" value="{{@old('compare_data')['floorPlans']['difference_between_super_and_carpet_area_in_percentage']}}" name="compare_data[floorPlans][difference_between_super_and_carpet_area_in_percentage]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="apartmentstatus">Apartment Status</label>
									<input class="form-control input @error('compare_data[floorPlans][apartment_status]') is-invalid @enderror" type="text" placeholder="Apartment Status (Raw, Standard, Semi-Furnished, Fully Furnished)" value="{{@old('compare_data')['floorPlans']['apartment_status']}}" name="compare_data[floorPlans][apartment_status]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="flooring">Flooring Types in Living Area and Master Bedroom</label>
									<input class="form-control input @error('compare_data[floorPlans][flooring_types_in_living_area_and_master_bedroom]') is-invalid @enderror" type="text" placeholder="Flooring Types in Living Area and Master Bedroom" value="{{@old('compare_data')['floorPlans']['flooring_types_in_living_area_and_master_bedroom']}}" name="compare_data[floorPlans][flooring_types_in_living_area_and_master_bedroom]" required> 
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="internal">Internal Height of an Apartment</label>
									<input class="form-control input @error('compare_data[floorPlans][internal_height_of_an_apartment]') is-invalid @enderror" type="text" placeholder="Flooring Types in Living Area and Master Bedroom" value="{{@old('compare_data')['floorPlans']['internal_height_of_an_apartment']}}" name="compare_data[floorPlans][internal_height_of_an_apartment]" required> 
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									
								</div>
								<div class="col-sm-12 col-lg-6 mt-2"> 
									<div class="form-group">
										<label for="floor_plans_descp">Floor plans Description:</label>
										<textarea name="floor_plans_descp" id="floor_plans_descp" class="summernote" required> {{@old('floor_plans_descp')}}</textarea>
									</div>
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-5">
									<div class="form-group fileInput">
										<label for="FeaturedImage">Brochure:</label>
										<input type="file" class="form-control  @error("media[floor_plans]") is-invalid @enderror" name="media[floor_plans]">	
									</div>
								</div>
								<div class="col-12">
								<h5>Project Possession details</h5>
								</div>
								<hr/>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="proposeddate">Proposed Start Date (as per rera)</label>
									<input class="form-control input @error('compare_data[possessions][proposed_start_date_as_per_rera]') is-invalid @enderror" type="text" placeholder="Enter Launch Date According RERA" value="{{@old('compare_data')['possessions']['proposed_start_date_as_per_rera']}}" name="compare_data[possessions][proposed_start_date_as_per_rera]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="enddate">Proposed End Date (as per rera)</label>
									<input class="form-control input @error('compare_data[possessions][proposed_end_date_as_per_rera]') is-invalid @enderror" type="text" placeholder="Enter Launch Date According RERA" value="{{@old('compare_data')['possessions']['proposed_end_date_as_per_rera']}}" name="compare_data[possessions][proposed_end_date_as_per_rera]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="status">Project Status</label>
									<input class="form-control input @error('compare_data[possessions][project_status]') is-invalid @enderror" type="text" placeholder="Enter Project Status" value="{{@old('compare_data')['possessions']['project_status']}}" name="compare_data[possessions][project_status]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="possdateinphase">Possession Date in Phases ( if phases exist)</label>
									<input class="form-control input @error('compare_data[possessions][possession_date_in_phases]') is-invalid @enderror" type="text" placeholder="Enter Possession Date in Phases(if phase exist)" value="{{@old('compare_data')['possessions']['possession_date_in_phases']}}" name="compare_data[possessions][possession_date_in_phases]" required>  
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="certificate">Occupancy Certificate Status (Not Applicable, Applied, not applied, received)</label>
									<input class="form-control input @error('compare_data[possessions][occupancy_certificate_status]') is-invalid @enderror" type="text" placeholder="Enter Certificate Status" value="{{@old('compare_data')['possessions']['occupancy_certificate_status']}}" name="compare_data[possessions][occupancy_certificate_status]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="certificate">Completion Certificate Status (Not Applicable, Not Applied, Applied, Received)</label>
									<input class="form-control input @error('compare_data[possessions][completion_certificate_status]') is-invalid @enderror" type="text" placeholder="Completion Certificate Status" value="{{@old('compare_data')['possessions']['completion_certificate_status']}}" name="compare_data[possessions][completion_certificate_status]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="registration">Registration of Apartments (Not Applicable, Yet to start ,Registration Started)</label>
									<input class="form-control input @error('compare_data[possessions][registration_of_apartments]') is-invalid @enderror" type="text" placeholder="Registration of Apartments" value="{{@old('compare_data')['possessions']['registration_of_apartments']}}" name="compare_data[possessions][registration_of_apartments]" required> 
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
								</div>
								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="possession_descp">Possessions Description:</label>
										<textarea name="possessions_descp" id="possessions_descp" class="summernote" required>{{@old('possessions_descp')}} </textarea>
									</div>
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-5">
									
								</div>
								<div class="col-12">
								<h5>Project Amenities details</h5>
								</div>
								<hr/>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="clubhousearea">Club House Area in Square Feet</label>
									<input class="form-control input @error('compare_data[amenities][club_house_area_in_sqft]') is-invalid @enderror" type="text" placeholder="Enter Club House Area in Sq ft" value="{{@old('compare_data')['amenities']['club_house_area_in_sqft']}}" name="compare_data[amenities][club_house_area_in_sqft]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="openspace">Open Space including Green Space</label> 
									<input class="form-control input @error('compare_data[amenities][open_space_including_green_space]') is-invalid @enderror" type="text" placeholder="Enter Open Space including Green Space" value="{{@old('compare_data')['amenities']['open_space_including_green_space']}}" name="compare_data[amenities][open_space_including_green_space]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="amenities">Amenities</label>
									<input class="form-control input @error('compare_data[amenities][amenities]') is-invalid @enderror" type="text" placeholder="Enter Amenities" value="{{@old('compare_data')['amenities']['amenities']}}" name="compare_data[amenities][amenities]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									
								</div>
								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="amenities_descp">Amenity Description:</label>
										<textarea name="amenities_descp" id="amenities_descp" class="summernote" required>{{@old('amenities_descp')}} </textarea>
									</div>
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-5">
									<div class="form-group fileInput">
										<label for="amenities">Amenity files:</label>
										<input type="file" class="form-control  @error("media[amenities]") is-invalid @enderror" name="media[amenities]" required>	
									</div>
								</div>
								<div class="col-12">
								<h5>Project Developer Background details</h5>
								</div>
								<hr/>
								<div class="col-sm-12 col-lg-6 mb-2"> 
									<label for="experience">Developer Experience in Years</label>
									<input class="form-control input @error('compare_data[devBackgrounds][developer_experience_in_year]') is-invalid @enderror" type="text" placeholder="Enter Developer Experience in Years" value="{{@old('compare_data')['devBackgrounds']['developer_experience_in_year']}}" name="compare_data[devBackgrounds][developer_experience_in_year]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="deliveredprojects">Delivered Projects in Numbers</label>
									<input class="form-control input @error('compare_data[devBackgrounds][delivered_projects]') is-invalid @enderror" type="text" placeholder="Enter Delivered Projects in Numbers" value="{{@old('compare_data')['devBackgrounds']['delivered_projects']}}" name="compare_data[devBackgrounds][delivered_projects]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="deliveries">Developers Notable Deliveries</label>
									<input class="form-control input @error('compare_data[devBackgrounds][developer_notable_deliveries]') is-invalid @enderror" type="text" placeholder="Enter Developers Notable Deliveries" value="{{@old('compare_data')['devBackgrounds']['developer_notable_deliveries']}}" name="compare_data[devBackgrounds][developer_notable_deliveries]" required>
								</div>
						        <div class="col-sm-12 col-lg-6 mb-2">
								</div>
								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="dev_backgrounds_descp">Developer Backgrounds:</label>
										<textarea name="dev_backgrounds_descp" id="dev_backgrounds_descp" class="summernote" required> {{@old('dev_backgrounds_descp')}}</textarea>
									</div>
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-5">
									
								</div>
								<div class="col-12">
								<h5>Project Pricing details</h5>
								</div>
								<hr/>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="currentBSP">Current Price (BSP in Salable Area)</label>
									<input class="form-control input @error('compare_data[pricings][current_price_BSP_in_salable_area]') is-invalid @enderror" type="text" placeholder="Initial Price(BSP in RERA Carpet Area)" value="{{@old('compare_data')['pricings']['current_price_BSP_in_salable_area']}}" name="compare_data[pricings][current_price_BSP_in_salable_area]" required> 
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="carpetprice">Current Price (BSP in RERA Carpet Area)</label>
									<input class="form-control input @error('compare_data[pricings][current_price_BSP_in_RERA_carpet_area]') is-invalid @enderror" type="text" placeholder="Enter Current Basic Selling Price" value="{{@old('compare_data')['pricings']['current_price_BSP_in_RERA_carpet_area']}}" name="compare_data[pricings][current_price_BSP_in_RERA_carpet_area]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="pricerange">Price Range</label>
									<input class="form-control input @error('compare_data[pricings][price_range]') is-invalid @enderror" type="text" placeholder="Enter Current Basic Selling Price According Phases" value="{{@old('compare_data')['pricings']['price_range']}}" name="compare_data[pricings][price_range]" required>
								</div>
							
								<div class="col-sm-12 col-lg-6 mb-2"> 
				                   
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-3"> 
									<div class="form-group">
										<label for="pricings_descp">Pricings Description:</label>
										<textarea name="pricings_descp" id="pricings_descp" class="summernote" required> {{old('pricings_descp')}}</textarea>  
									</div>
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-5">
									<div class="form-group fileInput">
										<label for="pricings">Pricings files:</label>
										<input type="file" class="form-control  @error("media[pricings]") is-invalid @enderror" name="media[pricings]">	
									</div>
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="advice_descp">Our Advices:</label>
										<textarea name="advices_descp" id="advices_descp" class="summernote" required>{{old('advices_descp')}}   
										</textarea>
									</div>
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-5">
									
								</div>
								<div class="col-12 mt-5">
									<h5>
										FAQs Section
									</h5>
								</div>
                                <div class="row p-3 faqs" style="width:100%">
								  @if(!empty(@old('faqs_data')) && count(@old('faqs_data'))>0)
								   @foreach(@old('faqs_data') as $key => $faqsData)
									<div class="col-sm-12 col-lg-12 mt-2 faqData" style="padding:0 30px">
										<div class="row pt-5 pb-5" style="background:#1b577733">
											<div class="col-6">
												<label for="question">Question:</label>
												<input value="{{$faqsData['question']}}" name="faqs_data[{{$key}}][question]" type="text" class="form-control" required>
											</div>
											<div class="col-6"> 
												<label for="answer">Answer:</label>
												<input  value="{{$faqsData['answer']}}"  name="faqs_data[{{$key}}][answer]" type="text" class="form-control" required>
											</div>
                                        </div>
                                    </div>
                                    @endforeach
									@else
                                    <div class="col-sm-12 col-lg-12 mt-2 faqData" style="padding:0 30px">
									    <div class="row pt-5 pb-5" style="background:#1b577733">
											<div class="col-6">
												<label for="question">Question:</label>
												<input name="faqs_data[0][question]" type="text" class="form-control" required>
											</div>
											<div class="col-6">
												<label for="answer">Answer:</label>
												<input name="faqs_data[0][answer]" type="text" class="form-control" required>
											</div>
											
										</div>
										<span class="bg-warning plusBtnFAQ">
											<i class="fa fa-plus"></i>
										</span>
									</div>
                                  @endif
                                </div>
								<div class="col-12 mt-3">
									<button type="submit" class="btn btn-primary">Save Details</button>
								</div>
							</div>
						</form>
						<!--guidlines section for the user-->
						<button id="openModalBtn" class="btn btn-primary fixed-right">Open Guidelines</button>
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Guidelines</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body p-5"> 
								<ol>
                                   <li class="p-2 mb-1">When completing the project details, ensure you do not copy and paste content.</li>
                                   <li class="p-2 mb-1">Use bullet points in an unordered list for list items.</li>
                                   <li class="p-2 mb-1">Place paragraph content within paragraph tags.</li>
                                   <li class="p-2 mb-1">Do not leave any file fields empty.</li>
                                   <li class="p-2 mb-1">For any string fields, if the details are unavailable, write "N/A".</li>
                                   <li class="p-2 mb-1">Do not leave any numeric fields empty; if the details are unavailable, write "0".</li>
                                </ol>

							  </div>
							</div>
						  </div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
@endsection

@section('customJs')
<script>
	function previewImage(input, previewId) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$(previewId).attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]); 
		}
	}

	// Function to re-index floor plan inputs
    function reIndexFloorPlans() {
        $('.floors .pdfloorPlans').each(function(index) {
            // Update index in input names
            $(this).find('[name^="floor_plans"]').each(function() {
                let newName = $(this).attr('name').replace(/\[\d+\]/, `[${index}]`);
                $(this).attr('name', newName);
            });
        });
    }

    // Plus button click event
    $('.plusBtn').click(function() {
        let currentIndex = $('.floors .pdfloorPlans').length; // Get the current number of floor plans

        let html = `<div class="col-sm-12 col-lg-12 mt-2 pdfloorPlans" style="padding:0 30px">
                        <div class="row pt-5 pb-5" style="background:#1b577733">
                            <div class="col">
                                <label for="title">Title:</label>
                                <input name="floor_plans[${currentIndex}][title]" type="text" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="super_area">Super Area:</label>
                                <input name="floor_plans[${currentIndex}][super_area]" type="text" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="carpet_area">Carpet Area:</label>
                                <input name="floor_plans[${currentIndex}][carpet_area]" type="text" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="built_area">Builtup Area:</label>
                                <input name="floor_plans[${currentIndex}][built_area]" type="text" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="balcony_area">Balcony Area:</label>
                                <input name="floor_plans[${currentIndex}][balcony_area]" type="text" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="feature_image">Image:</label>
                                <input name="floor_plans[${currentIndex}][feature_image]" type="file" class="form-control" required>
                            </div>
                        </div>
                        <span class="bg-danger minusBtn">
                            <i class="fa fa-minus"></i>
                        </span>
                    </div>`;
        $('.floors').append(html);
        reIndexFloorPlans();
    });
    $(document).on('click', '.minusBtn', function() {
        $(this).closest('.pdfloorPlans').remove();
        reIndexFloorPlans();
    });
	
	$('#openModalBtn').click(function(){
      $('#myModal').modal('show');
    });
</script>
<script>
   //function to re-index the FAQs index
     function reIndexFaqsData() {
        $('.faqs .faqData').each(function(index) {
            // Update index in input names
            $(this).find('[name^="faqs_data"]').each(function() {
                let newName = $(this).attr('name').replace(/\[\d+\]/, `[${index}]`);
                $(this).attr('name', newName);
            });
        });
    }
    // plus button click event for the Faq data
    $('.plusBtnFAQ').click(function() { 
        let currentIndex = $('.faqs .faqData').length; // Get the current number of floor plans

        let html = `<div class="col-sm-12 col-lg-12 mt-2 faqData" style="padding:0 30px">
                        <div class="row pt-5 pb-5" style="background:#1b577733">
                            
                            <div class="col-6">
                                <label for="question">Question:</label>
                                <input name="faqs_data[${currentIndex}][question]" type="text" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label for="answer">Answer:</label>
                                <input name="faqs_data[${currentIndex}][answer]" type="text" class="form-control" required>
                            </div>
                        </div>
                        <span class="bg-danger minusBtnFAQ">
                            <i class="fa fa-minus"></i>
                        </span>
                    </div>`;
        $('.faqs').append(html);
        reIndexFaqsData();
    });
    $(document).on('click', '.minusBtnFAQ', function() {
        $(this).closest('.faqData').remove();
        reIndexFaqsData();
    });
	
	$('#openModalBtn').click(function(){
      $('#myModal').modal('show');
    }); 
</script>
@endsection