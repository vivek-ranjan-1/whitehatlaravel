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
			<div class="card contentCard projects">
				<div class="card">
					<div class="card-header">
						<b>Basic Information</b>
					</div>
					<div class="card-body">
						<form method="POST" action="{{route('projects.update')}}" enctype="multipart/form-data">
							@csrf
							<input name="id" value="{{request()->route('id')}}" type="hidden">
							<div class="row">
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Project Name</label>
									<input class="form-control input @error('name') is-invalid @enderror " type="text"
										placeholder="Enter Project Name"
										value="{{(old('name')) ? old('name') : (@$project->name)}}" name="name" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Owner Name</label>
									<input class="form-control input  @error('owner_name') is-invalid @enderror"
										type="text" name="owner_name"
										value="{{(old('owner_name')) ? old('owner_name') : (@$project->owner_name)}}"
										placeholder="Enter Owner Name" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Project Status</label>
									<select placeholder="Select Project Status" name="delivery_status"
										class="form-control input select2">
										<option value="new_launch" {{ (old('delivery_status')=='new_launch' ||
											@$project->delivery_status == 'new_launch') ? 'selected' : '' }}>New launch
										</option>
										<option value="ready_to_move" {{ (old('delivery_status')=='ready_to_move' ||
											@$project->delivery_status == 'ready_to_move') ? 'selected' : '' }}>Ready To
											Move</option>
										<option value="under_construction" {{
											(old('delivery_status')=='under_construction' || @$project->delivery_status
											== 'under_construction') ? 'selected' : '' }}>Under Construction</option>
										<option value="possession_within_year" {{
											(old('delivery_status')=='possession_within_year' || @$project->
											delivery_status == 'possession_within_year') ? 'selected' : '' }}>Possession
											Within a Year</option>
									</select>
								</div>

								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">SEO Title</label>
									<input class="form-control input @error('title') is-invalid @enderror" type="text"
										placeholder="Enter Project SEO Title"
										value="{{(old('title')) ? old('title') : (@$project->title)}}" name="title"
										required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Keywords</label>
									<input class="form-control input @error('keywords') is-invalid @enderror"
										type="text" placeholder="Enter Project Keywords"
										value="{{(old('keywords')) ? old('keywords') : (@$project->keywords)}}"
										name="keywords" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Initial BSP for Super Area <span class="text-danger">(Numeric only*)  </span></label>
									<input class="form-control input @error('initial_bsp_super_area') is-invalid @enderror" type="text" placeholder="Enter Initial BSP for Super Area" value="{{(@old('initial_bsp_super_area')) ? @old('initial_bsp_super_area') : (@$project->initial_bsp_super_area)}}" name="initial_bsp_super_area" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">BSP for Super Area<span class="text-danger">(Numeric only*)  </span></label>
									<input class="form-control input @error('bsp_super_area') is-invalid @enderror"
										type="text" placeholder="Enter BSP for Super Area"
										value="{{(@old('bsp_super_area')) ? @old('bsp_super_area') : (@$project->bsp_super_area)}}"
										name="bsp_super_area" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Meta Description</label>
									<input class="form-control input @error('meta_description') is-invalid @enderror"
										type="text" placeholder="Enter Project Meta Description"
										value="{{(old('meta_description')) ? old('meta_description') : (@$project->meta_description)}}"
										name="meta_description" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Canonical Link</label>
									<input class="form-control input @error('canonical_link') is-invalid @enderror" type="text" placeholder="Enter Project Canonical Link" value="{{(old('canonical_link')) ? @old('canonical_link') : (@$project->canonical_link)}}" name="canonical_link" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Image Alt Tag</label>
									<input class="form-control input @error('image_alt_tag') is-invalid @enderror" type="text" placeholder="Enter Project Image Alt Tag" value="{{(old('image_alt_tag')) ? @old('image_alt_tag') : (@$project->image_alt_tag)}}" name="image_alt_tag" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">RERA Number</label>
									<input class="form-control input @error('rera_no') is-invalid @enderror" type="text"
										placeholder="Enter RERA Number"
										value="{{(old('rera_no')) ? old('rera_no') : (@$project->rera_no)}}"
										name="rera_no" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Minimum Price</label>
									<input class="form-control input @error('min_price') is-invalid @enderror"
										type="text" placeholder="Enter Minimum Price"
										value="{{(old('min_price')) ? old('min_price') : (@$project->min_price)}}"
										name="min_price" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Maximum Price</label>
									<input class="form-control input @error('max_price') is-invalid @enderror"
										type="text" placeholder="Enter Maximum Price"
										value="{{(old('max_price')) ? old('max_price') : (@$project->max_price)}}"
										name="max_price" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Land Area</label>
									<input class="form-control input @error('land_area') is-invalid @enderror"
										type="text" placeholder="Enter Land Area"
										value="{{(old('land_area')) ? old('land_area') : (@$project->land_area)}}"
										name="land_area" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Location</label>
									<input class="form-control input @error('location') is-invalid @enderror"
										type="text" placeholder="Enter Project Location"
										value="{{(old('location')) ? old('location') : (@$project->location)}}"
										name="location" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="city">City</label>
									<input class="form-control input @error('city') is-invalid @enderror"
										type="text" placeholder="Enter Project City"
										value="{{(old('city')) ? old('city') : (@$project->city)}}"
										name="city" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">BHK Types</label>
									<input class="form-control input @error('bhk_types') is-invalid @enderror"
										type="text" placeholder="Enter BHK Types"
										value="{{(old('bhk_types')) ? old('bhk_types') : (@$project->bhk_types)}}"
										name="bhk_types" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">YouTube Link <span class="text-danger">(URL only*)</span></label>
									<input class="form-control input @error('youtube_link') is-invalid @enderror"
										type="url" placeholder="Enter Project YouTube Link"
										value="{{(old('youtube_link')) ? old('youtube_link') : (@$project->youtube_link)}}"
										name="youtube_link" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Number of Towers</label>
									<input class="form-control input @error('towers') is-invalid @enderror" type="text"
										placeholder="Enter Number of Towers"
										value="{{(old('towers')) ? old('towers') : (@$project->highlights->towers)}}"
										name="towers" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Number of Parking<span class="text-danger">(Numeric only*)</span></label>
									<input class="form-control input @error('parking') is-invalid @enderror" type="text"
										placeholder="Enter Parking Area"
										value="{{(old('parking')) ? old('parking') : (@$project->highlights->parking)}}"
										name="parking" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Density Unit Per Acre</label>
									<input
										class="form-control input @error('density_unit_per_area') is-invalid @enderror"
										type="text" placeholder="Enter Density Unit Per Area"
										value="{{(old('density_unit_per_area')) ? old('density_unit_per_area') : (@$project->highlights->density_unit_per_area)}}"
										name="density_unit_per_area" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Number of Apartments</label>
									<input class="form-control input @error('no_of_apartments') is-invalid @enderror"
										type="text" placeholder="Enter Number of Apartments"
										value="{{(old('no_of_apartments')) ? old('no_of_apartments') : (@$project->highlights->no_of_apartments)}}"
										name="no_of_apartments" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Apartment to Lift Ratio <span class="text-danger">(Numeric Only*)</span></label>
									<input class="form-control input @error('lift_ratio') is-invalid @enderror"
										type="text" placeholder="Enter Lift Ratio"
										value="{{(old('lift_ratio')) ? old('lift_ratio') : (@$project->highlights->lift_ratio)}}"
										name="lift_ratio" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Launch Date</label>
									<input class="form-control input @error('launch_date') is-invalid @enderror"
										type="text" placeholder="Enter Launch Date"
										value="{{(old('launch_date')) ? old('launch_date') : (@$project->possessions->launch_date)}}"
										name="launch_date" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Possession as Per RERA Date</label>
									<input
										class="form-control input @error('possession_rera_date') is-invalid @enderror"
										type="text" placeholder="Enter Possession as per RERA Date"
										value="{{(old('possession_rera_date')) ? old('possession_rera_date') : (@$project->possessions->possession_rera_date)}}"
										name="possession_rera_date" required> 
								</div>

								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Developer Experience <span class="text-danger">(Numeric
											only*)</span></label>
									<input class="form-control input @error('experience') is-invalid @enderror"
										type="text" placeholder="Enter Possession as per RERA Date"
										value="{{(old('experience')) ? old('experience') : (@$project->devBackgrounds->experience)}}"
										name="experience" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Projects Delivered <span class="text-danger">(Numeric
											only*)</label>
									<input class="form-control input @error('projects_delivered') is-invalid @enderror"
										type="text" placeholder="Enter Projects Delivered"
										value="{{(old('projects_delivered')) ? old('projects_delivered') : (@$project->devBackgrounds->projects_delivered)}}"
										name="projects_delivered" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Ongoing Projects <span class="text-danger">(Numeric
											only*)</span></label>
									<input class="form-control input @error('ongoing_projects') is-invalid @enderror"
										type="text" placeholder="Enter Ongoing Projects"
										value="{{(old('ongoing_projects')) ? old('ongoing_projects') : (@$project->devBackgrounds->ongoing_projects)}}"
										name="ongoing_projects" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
									<label for="name">Timely Project Delivered Ratio</label>
									<input class="form-control input @error('area_built') is-invalid @enderror"
										type="text" placeholder="Enter Timely Project Delivered Ratio"
										value="{{(old('area_built')) ? old('area_built') : (@$project->devBackgrounds->area_built)}}"
										name="area_built" required>
								</div>
								
								<div class="col-12"></div>
								<div class="col-sm-12 col-lg-6 d-flex">
									<div class="form-group fileInput mr-2">
										<label for="thumbnail">Project Logo:</label>
										<input type="file" class="form-control @error('logo') is-invalid @enderror"
											name="logo" onchange="previewImage(this, '#previewLogo')"
											placeholder="Project Logo" id="logo">
									</div>
									<div class="fileInput">
										<img src="{{url('storage/'.$project->logo)}}" alt="logo" id="previewLogo"
											width="100%">
									</div>
								</div>
								<div class="col-sm-12 col-lg-6 d-flex">
									<div class="form-group fileInput mr-2">
										<label for="FeaturedImage">Featured Image:</label>
										<input type="file"
											class="form-control  @error('featured_image') is-invalid @enderror"
											name="featured_image" onchange="previewImage(this, '#previewFeaturedImage')"
											placeholder="featuredImage" id="featuredImage">
									</div>
									<div class="fileInput">
										<img src="{{url('storage/'.$project->featured_image)}}" alt="photo"
											id="previewFeaturedImage">
									</div>
								</div>
								<div class="col-12">
									<h5>Location Details</h5>
								</div>
								<hr />
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="metro">Nearest Metro Station </label>
									<input
										class="form-control input @error('compare_data[locations][nearest_metro]') is-invalid @enderror"
										type="text" placeholder="Enter Nearest Metro Station"
										value="{{(@old('compare_data')['locations']['nearest_metro']) ? (@old('compare_data')['locations']['nearest_metro']) : (@$project->compare_data->locations->nearest_metro)}}"
										name="compare_data[locations][nearest_metro]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="metro">Nearest Railway Station </label>
									<input
										class="form-control input @error('compare_data[locations][nearest_railway]') is-invalid @enderror"
										type="text" placeholder="Enter Nearest Railway Station"
										value="{{(@old('compare_data')['locations']['nearest_railway']) ? (@old('compare_data')['locations']['nearest_railway']) : (@$project->compare_data->locations->nearest_railway)}}"
										name="compare_data[locations][nearest_railway]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="metro">Nearest Airport </label>
									<input
										class="form-control input @error('compare_data[locations][nearest_airport]') is-invalid @enderror"
										type="text" placeholder="Enter Nearest Airport"
										value="{{(@old('compare_data')['locations']['nearest_airport']) ? (@old('compare_data')['locations']['nearest_airport']) : (@$project->compare_data->locations->nearest_airport)}}"
										name="compare_data[locations][nearest_airport]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="metro">Hospitals in 10 Kms Radius (3-4 options)</label>
									<input
										class="form-control input @error('compare_data[locations][nearest_hospitals]') is-invalid @enderror"
										type="text" placeholder="Enter Nearest Hospitals"
										value="{{(@old('compare_data')['locations']['nearest_hospitals']) ? (@old('compare_data')['locations']['nearest_hospitals']) : (@$project->compare_data->locations->nearest_hospitals)}}"
										name="compare_data[locations][nearest_hospitals]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="metro">Schools in 10 Kms Radius (3-4 options)</label>
									<input
										class="form-control input @error('compare_data[locations][nearest_schools]') is-invalid @enderror"
										type="text" placeholder="Enter Nearest Schools"
										value="{{(@old('compare_data')['locations']['nearest_schools']) ? (@old('compare_data')['locations']['nearest_schools']) : (@$project->compare_data->locations->nearest_schools)}}"
										name="compare_data[locations][nearest_schools]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="road">Road Connectivity</label>
									<input
										class="form-control input @error('compare_data[locations][road_connectivity]') is-invalid @enderror"
										type="text" placeholder="Road Connectivity"
										value="{{(@old('compare_data')['locations']['road_connectivity']) ? (@old('compare_data')['locations']['road_connectivity']) : (@$project->compare_data->locations->road_connectivity)}}"
										name="compare_data[locations][road_connectivity]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="road">Other Nearby Facilities</label>
									<input
										class="form-control input @error('compare_data[locations][other_nearby_facilities]') is-invalid @enderror"
										type="text" placeholder="Other Nearby Facilities"
										value="{{(@old('compare_data')['locations']['other_nearby_facilities']) ? (@old('compare_data')['locations']['other_nearby_facilities']) : (@$project->compare_data->locations->other_nearby_facilities)}}"
										name="compare_data[locations][other_nearby_facilities]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">

								</div>
								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="locations_descp">Location Description:</label>
										<textarea name="locations_descp" id="locations_descp" class="summernote">
										{{(@old('locations_descp')) ? (@old('locations_descp')) :(@$project->locations->locations_descp)}} 
										</textarea>
									</div>
								</div>
								<div class="col-sm-12 col-lg-6 mt-5">
									<div class="form-group fileInput">
										<label for="FeaturedImage">Location files:</label>
										<input type="file" class="form-control  @error(" media[locations]") is-invalid
											@enderror" name="media[locations]" 
											onchange="previewImage(this, '#previewLocationImage')" id="locationImage">
									</div>
									@if($files->locations)
									<div class="mt-4 text-center">
											<video width="320" height="150" controls autoplay muted>
											  <source src="{{url('storage/'.$files->locations)}}" type="video/mp4">
											  Your browser does not support the video tag.
											</video>
									</div>
									@endif
								</div>

								<div class="col-12">
									<h5>Project Highlights details</h5>
								</div>
								<hr />
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="landsize">Land Size in Acres </label>
									<input
										class="form-control input @error('compare_data[highlights][land_size_in_acres]') is-invalid @enderror"
										type="text" placeholder="Enter Land Size in Acres"
										value="{{(@old('compare_data')['highlights']['land_size_in_acres']) ? (@old('compare_data')['highlights']['land_size_in_acres']) : (@$project->compare_data->highlights->land_size_in_acres)}}"
										name="compare_data[highlights][land_size_in_acres]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="noofphases">Total Number of Phases </label>
									<input
										class="form-control input @error('compare_data[highlights][total_number_of_phases]') is-invalid @enderror"
										type="text" placeholder="Enter Total Number of Phases"
										value="{{(@old('compare_data')['highlights']['total_number_of_phases']) ? (@old('compare_data')['highlights']['total_number_of_phases']) : (@$project->compare_data->highlights->total_number_of_phases)}}"
										name="compare_data[highlights][total_number_of_phases]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="tower">Number of Towers (According to phases if phases are
										there)</label>
									<input
										class="form-control input @error('compare_data[highlights][total_number_of_tower]') is-invalid @enderror"
										type="text" placeholder="Enter Number of Tower"
										value="{{(@old('compare_data')['highlights']['total_number_of_tower']) ? (@old('compare_data')['highlights']['total_number_of_tower']) : (@$project->compare_data->highlights->total_number_of_tower)}}"
										name="compare_data[highlights][total_number_of_tower]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="noofunits">Total Number of Units</label>
									<input
										class="form-control input @error('compare_data[highlights][total_number_of_unit]') is-invalid @enderror"
										type="text" placeholder="Enter Total Number of Units"
										value="{{(@old('compare_data')['highlights']['total_number_of_unit']) ? (@old('compare_data')['highlights']['total_number_of_unit']) : (@$project->compare_data->highlights->total_number_of_unit)}}"
										name="compare_data[highlights][total_number_of_unit]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="accommodations">Accommodations(In BHK)</label>
									<input
										class="form-control input @error('compare_data[highlights][accommodations_in_BHK]') is-invalid @enderror"
										type="text" placeholder="Enter Accommodations In BHK"
										value="{{(@old('compare_data')['highlights']['accommodations_in_BHK']) ? (@old('compare_data')['highlights']['accommodations_in_BHK']) : (@$project->compare_data->highlights->accommodations_in_BHK)}}"
										name="compare_data[highlights][accommodations_in_BHK]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="construction">Project Construction (Mivan or Bricks Based)</label>
									<input
										class="form-control input @error('compare_data[highlights][project_construction]') is-invalid @enderror"
										type="text" placeholder="Enter Project Construction (Mivan or Bricks Based)"
										value="{{(@old('compare_data')['highlights']['project_construction']) ? (@old('compare_data')['highlights']['project_construction']) : (@$project->compare_data->highlights->project_construction)}}"
										name="compare_data[highlights][project_construction]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="towerheight">Tower Height (upto)</label>
									<input
										class="form-control input @error('compare_data[highlights][tower_height_upto]') is-invalid @enderror"
										type="text" placeholder="Enter Average Tower Height"
										value="{{(@old('compare_data')['highlights']['tower_height_upto']) ? (@old('compare_data')['highlights']['tower_height_upto']) : (@$project->compare_data->highlights?->tower_height_upto)}}"
										name="compare_data[highlights][tower_height_upto]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="podiumbased">Podium Based Structure</label>
									<input
										class="form-control input @error('compare_data[highlights][podium_based_structure]') is-invalid @enderror"
										type="text" placeholder="Enter Project is Podium Based or Not"
										value="{{(@old('compare_data')['highlights']['podium_based_structure']) ? (@old('compare_data')['highlights']['podium_based_structure']) : (@$project->compare_data->highlights->podium_based_structure)}}"
										name="compare_data[highlights][podium_based_structure]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="towerheight">Level of Basement</label>
									<input
										class="form-control input @error('compare_data[highlights][level_of_basement]') is-invalid @enderror"
										type="text" placeholder="Enter Level of Basement"
										value="{{(@old('compare_data')['highlights']['level_of_basement']) ? (@old('compare_data')['highlights']['level_of_basement']) : (@$project->compare_data->highlights->level_of_basement)}}"
										name="compare_data[highlights][level_of_basement]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="lift">Number of Lift According to Tower</label>
									<input
										class="form-control input @error('compare_data[highlights][number_of_lift_according_to_tower]') is-invalid @enderror"
										type="text" placeholder="Enter Number of Lifts According to Tower"
										value="{{(@old('compare_data')['highlights']['number_of_lift_according_to_tower']) ? (@old('compare_data')['highlights']['number_of_lift_according_to_tower']) : (@$project->compare_data->highlights->number_of_lift_according_to_tower)}}"
										name="compare_data[highlights][number_of_lift_according_to_tower]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="lifttoapartment">Lift to Apartment Ratio</label>
									<input
										class="form-control input @error('compare_data[highlights][lift_to_apartment_ratio]') is-invalid @enderror"
										type="text" placeholder="Enter Lift to Apartment Ratio"
										value="{{(@old('compare_data')['highlights']['lift_to_apartment_ratio']) ? (@old('compare_data')['highlights']['lift_to_apartment_ratio']) : (@$project->compare_data->highlights->lift_to_apartment_ratio)}}"
										name="compare_data[highlights][lift_to_apartment_ratio]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="noofparking">Total Number of Parking</label>
									<input
										class="form-control input @error('compare_data[highlights][total_number_of_parking]') is-invalid @enderror"
										type="text" placeholder="Enter Total Number Of Parking"
										value="{{(@old('compare_data')['highlights']['total_number_of_parking']) ? (@old('compare_data')['highlights']['total_number_of_parking']) : (@$project->compare_data->highlights->total_number_of_parking)}}"
										name="compare_data[highlights][total_number_of_parking]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="parkingperapartment">Average Number of Parking Per Apartments</label>
									<input
										class="form-control input @error('compare_data[highlights][average_number_of_parking_per_apartments]') is-invalid @enderror"
										type="text" placeholder="Enter Average Number of Parking per Apartments"
										value="{{(@old('compare_data')['highlights']['average_number_of_parking_per_apartments']) ? (@old('compare_data')['highlights']['average_number_of_parking_per_apartments']) : (@$project->compare_data->highlights->average_number_of_parking_per_apartments)}}"
										name="compare_data[highlights][average_number_of_parking_per_apartments]"
										required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="apartmentperfloor">Apartment Per Floor Tower Wise</label>
									<input
										class="form-control input @error('compare_data[highlights][apartment_per_floor_tower_wise]') is-invalid @enderror"
										type="text" placeholder="Enter Apartment Per Floor Tower Wise"
										value="{{(@old('compare_data')['highlights']['apartment_per_floor_tower_wise']) ? (@old('compare_data')['highlights']['apartment_per_floor_tower_wise']) : (@$project->compare_data->highlights->apartment_per_floor_tower_wise)}}"
										name="compare_data[highlights][apartment_per_floor_tower_wise]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="apartmentsacres">Apartments Per Acres</label>
									<input
										class="form-control input @error('compare_data[highlights][apartments_per_acres]') is-invalid @enderror"
										type="text" placeholder="Enter Apartments Per Acres"
										value="{{(@old('compare_data')['highlights']['apartments_per_acres']) ? (@old('compare_data')['highlights']['apartments_per_acres']) : (@$project->compare_data->highlights->apartments_per_acres)}}"
										name="compare_data[highlights][apartments_per_acres]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="openspace">Open Space in Percentage (including green area)</label>
									<input
										class="form-control input @error('compare_data[highlights][open_space_including_green_space]') is-invalid @enderror"
										type="text" placeholder="Enter Open Space in Percentage"
										value="{{(@old('compare_data')['highlights']['open_space_including_green_space']) ? (@old('compare_data')['highlights']['open_space_including_green_space']) : (@$project->compare_data->highlights->open_space_including_green_space)}}"
										name="compare_data[highlights][open_space_including_green_space]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="clubarea">Club Area in Square Feet</label>
									<input
										class="form-control input @error('compare_data[highlights][club_area_in_sqft]') is-invalid @enderror"
										type="text" placeholder="Enter Club Area in Square Feet"
										value="{{(@old('compare_data')['highlights']['club_area_in_sqft']) ? (@old('compare_data')['highlights']['club_area_in_sqft']) : (@$project->compare_data->highlights->club_area_in_sqft)}}"
										name="compare_data[highlights][club_area_in_sqft]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="landstatus">Land Status (Fully paid or Partial Paid)</label>
									<input
										class="form-control input @error('compare_data[highlights][land_status]') is-invalid @enderror"
										type="text" placeholder="Enter Open Space in Percentage"
										value="{{(@old('compare_data')['highlights']['land_status']) ? (@old('compare_data')['highlights']['land_status']) : (@$project->compare_data->highlights->land_status)}}"
										name="compare_data[highlights][land_status]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="projectstatus">Project Status</label>
									<input
										class="form-control input @error('compare_data[highlights][project_status]') is-invalid @enderror"
										type="text" placeholder="Enter Project Status"
										value="{{(@old('compare_data')['highlights']['project_status']) ? (@old('compare_data')['highlights']['project_status']) : (@$project->compare_data->highlights->project_status)}}"
										name="compare_data[highlights][project_status]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="homeloan">Banks Name for Home Loan</label>
									<input
										class="form-control input @error('compare_data[highlights][home_loan_facility]') is-invalid @enderror"
										type="text" placeholder="Enter Two or Three Bank Name"
										value="{{(@old('compare_data')['highlights']['home_loan_facility']) ? (@old('compare_data')['highlights']['home_loan_facility']) : (@$project->compare_data->highlights->home_loan_facility)}}"
										name="compare_data[highlights][home_loan_facility]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="highlights_descp">Highlights Description:</label>
										<textarea name="highlights_descp" id="highlights_descp" class="summernote">
										{{(@old('highlights_descp')) ? (@old('highlights_descp')) : (@$project->highlights->highlights_descp)}}
										</textarea>
									</div>
								</div>

								<div class="col-sm-12 col-lg-6 mt-5">
									<div class="form-group fileInput">
										<label for="FeaturedImage">Highlights files: <span class="text-danger">(1 Images
												only*)</span></label>
										<input type="file" class="form-control  @error(" media[highlights]") is-invalid
											@enderror" name="media[highlights]"
											onchange="previewImage(this, '#previewHighlightImage')" id="highlightImage" >
									</div>
									@if($files->highlights)
									<div class="mt-4 text-center">
										<img src="{{url('storage/'.$files->highlights)}}" alt="photo" id="previewHighlightImage"
											width="40%">
									</div>
									@endif
								</div>
								<div class="col-12 mt-5">
									<h5>
										BHK Plans
									</h5>
								</div>
								<div class="floors row p-3">
									@if(!empty(json_decode($project->floorPlans->floor_plans_data)) &&
									count(json_decode($project->floorPlans->floor_plans_data))>0)
									@foreach(json_decode($project->floorPlans->floor_plans_data) as $index =>
									$floorPlan)
									<div class="col-sm-12 col-lg-12 mt-2 pdfloorPlans" style="padding:0 30px">
										<div class="row pt-5 pb-5" style="background:#1b577733">
											<div class="col">
												<label for="title">Title:</label>
												<input name="floor_plans[{{@$index}}][title]" type="text"
													class="form-control"
													value="{{(@old('title')) ? (@old('title')) : (@$floorPlan->title)}}" required>
											</div>
											<div class="col">
												<label for="super_area">Super Area:</label>
												<input name="floor_plans[{{@$index}}][super_area]" type="text"
													class="form-control"
													value="{{(@old('super_area')) ? (@old('super_area')) : (@$floorPlan->super_area)}}" required>
											</div>
											<div class="col">
												<label for="carpet_area">Carpet Area:</label>
												<input name="floor_plans[{{@$index}}][carpet_area]" type="text"
													class="form-control"
													value="{{(@old('carpet_area')) ? (@old('carpet_area')) : (@$floorPlan->carpet_area)}}" required>
											</div>
											<div class="col">
												<label for="built_area">Builtup Area:</label>
												<input name="floor_plans[{{@$index}}][built_area]" type="text"
													class="form-control"
													value="{{(@old('built_area')) ? (@old('built_area')) : (@$floorPlan->built_area)}}" required>
											</div>
											<div class="col">
												<label for="balcony_area">Balcony Area:</label>
												<input name="floor_plans[{{@$index}}][balcony_area]" type="text"
													class="form-control"
													value="{{(@old('balcony_area')) ? (@old('balcony_area')) : (@$floorPlan->balcony_area)}}" required>
											</div>
											<div class="col">
												<label for="feature_image">Image:</label>
												<input name="floor_plans[{{@$index}}][feature_image]" type="file"
													class="form-control">
											</div>
										</div>
										@if($index == 0)
										<span class="bg-warning plusBtn">
											<i class="fa fa-plus"></i>
										</span>
										@else
										<span class="bg-danger minusBtn">
											<i class="fa fa-minus"></i>
										</span>
										@endif
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
									<h5>Floor Plans details</h5>
								</div>
								<hr />
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="superarea">Super Area of All Varients</label>
									<input
										class="form-control input @error('compare_data[floorPlans][super_area_of_all_variants]') is-invalid @enderror"
										type="text" placeholder="Enter Super Area of All Varients"
										value="{{(@old('compare_data')['floorPlans']['super_area_of_all_variants']) ? (@old('compare_data')['floorPlans']['super_area_of_all_variants']) : (@$project->compare_data->floorPlans->super_area_of_all_variants)}}"
										name="compare_data[floorPlans][super_area_of_all_variants]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="carpetarea">RERA Carpet Area for all Variants</label>
									<input
										class="form-control input @error('compare_data[floorPlans][carpet_area_of_all_variants]') is-invalid @enderror"
										type="text" placeholder="Enter Super Area of All Varients"
										value="{{(@old('compare_data')['floorPlans']['carpet_area_of_all_variants']) ? (@old('compare_data')['floorPlans']['carpet_area_of_all_variants']) : (@$project->compare_data->floorPlans->carpet_area_of_all_variants)}}"
										name="compare_data[floorPlans][carpet_area_of_all_variants]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="floorplans">Floor Plans</label>
									<input
										class="form-control input @error('compare_data[floorPlans][floor_plans]') is-invalid @enderror"
										type="text" placeholder="Enter Floor Plans"
										value="{{(@old('compare_data')['floorPlans']['floor_plans']) ? (@old('compare_data')['floorPlans']['floor_plans']) : (@$project->compare_data->floorPlans->floor_plans)}}"
										name="compare_data[floorPlans][floor_plans]" required>
								</div>
                                 <div class="col-sm-12 col-lg-6 mb-2">
									<label for="difference">Difference between Super and Carpet Area in percentage</label>
									<input class="form-control input @error('compare_data[floorPlans][difference_between_super_and_carpet_area_in_percentage]') is-invalid @enderror" type="text" placeholder="Difference between super and carpet area in percentage" value="{{(@old('compare_data')['floorPlans']['difference_between_super_and_carpet_area_in_percentage'])? (@old('compare_data')['floorPlans']['difference_between_super_and_carpet_area_in_percentage']): (@$project->compare_data->floorPlans->difference_between_super_and_carpet_area_in_percentage)}}" name="compare_data[floorPlans][difference_between_super_and_carpet_area_in_percentage]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="apartmentstatus">Apartment Status</label>
									<input
										class="form-control input @error('compare_data[floorPlans][apartment_status]') is-invalid @enderror"
										type="text"
										placeholder="Enter Apartment Status(Raw, Standard, Semi-Furnished, Fully Furnished)"
										value="{{(@old('compare_data')['floorPlans']['apartment_status']) ? (@old('compare_data')['floorPlans']['apartment_status']) : (@$project->compare_data->floorPlans->apartment_status)}}"
										name="compare_data[floorPlans][apartment_status]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="flooring">Flooring Options (Tiles, Wooden Flooring or Marble)</label>
									<input
										class="form-control input @error('compare_data[floorPlans][flooring_types_in_living_area_and_master_bedroom]') is-invalid @enderror"
										type="text" placeholder="Enter Flooring Options"
										value="{{(@old('compare_data')['floorPlans']['flooring_types_in_living_area_and_master_bedroom']) ? (@old('compare_data')['floorPlans']['flooring_types_in_living_area_and_master_bedroom']) : (@$project->compare_data->floorPlans->flooring_types_in_living_area_and_master_bedroom)}}"
										name="compare_data[floorPlans][flooring_types_in_living_area_and_master_bedroom]"
										required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="height">Internal Height of an Apartment</label>
									<input
										class="form-control input @error('compare_data[floorPlans][internal_height_of_an_apartment]') is-invalid @enderror"
										type="text" placeholder="Internal Height of an Apartment"
										value="{{(@old('compare_data')['floorPlans']['internal_height_of_an_apartment']) ? (@old('compare_data')['floorPlans']['internal_height_of_an_apartment']) : (@$project->compare_data->floorPlans->internal_height_of_an_apartment)}}"
										name="compare_data[floorPlans][internal_height_of_an_apartment]" required>
								</div>
                                <div class="col-sm-12 col-lg-6 mb-2">
								</div>
								<div class="col-sm-12 col-lg-6 mt-2">
									<div class="form-group">
										<label for="floor_plans_descp">Floor plans Description:</label>
										<textarea name="floor_plans_descp" id="floor_plans_descp"
											class="summernote"> {{(@old('floor_plans_descp')) ? (@old('floor_plans_descp')) : (@$project->floorPlans->floor_plans_descp)}}</textarea>
									</div>
								</div>

								<div class="col-sm-12 col-lg-6 mt-5">
									<div class="form-group fileInput">
										<label for="FeaturedImage">Floor plans files:</label>
										<input type="file" class="form-control  @error(" media[floor_plans]") is-invalid
											@enderror" name="media[floor_plans]"
											onchange="previewImage(this, '#previewFloorPlanImage')" id="floorPlanImage">
									</div>
									@if(isset($files->floor_plans))
									<div class="mt-4 text-center">
										<a target="__blank" href="{{url('storage/'.$files->floor_plans)}}" alt="photo"
											class="btn btn-primary"> Download <i class="ml-2 fa fa-download"></i>
										</a>
									</div>
									@endif
								</div>

								<div class="col-12">
									<h5>Project Possession details</h5>
								</div>
								<hr />
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="proposeddate">Proposed Start Date (as per rera)</label>
									<input
										class="form-control input @error('compare_data[possessions][proposed_start_date_as_per_rera]') is-invalid @enderror"
										type="text" placeholder="Enter Launch Date According RERA"
										value="{{(@old('compare_data')['possessions']['proposed_start_date_as_per_rera']) ? (@old('compare_data')['possessions']['proposed_start_date_as_per_rera']) : (@$project->compare_data->possessions->proposed_start_date_as_per_rera)}}"
										name="compare_data[possessions][proposed_start_date_as_per_rera]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="enddate">Proposed End Date (as per rera)</label>
									<input
										class="form-control input @error('compare_data[possessions][proposed_end_date_as_per_rera]') is-invalid @enderror"
										type="text" placeholder="Enter Launch Date According RERA"
										value="{{(@old('compare_data')['possessions']['proposed_end_date_as_per_rera']) ? (@old('compare_data')['possessions']['proposed_end_date_as_per_rera']) : (@$project->compare_data->possessions->proposed_end_date_as_per_rera)}}"
										name="compare_data[possessions][proposed_end_date_as_per_rera]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="status">Project Status</label>
									<input
										class="form-control input @error('compare_data[possessions][project_status]') is-invalid @enderror"
										type="text" placeholder="Enter Project Status"
										value="{{(@old('compare_data')['possessions']['project_status']) ? (@old('compare_data')['possessions']['project_status']) : (@$project->compare_data->possessions->project_status)}}"
										name="compare_data[possessions][project_status]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="possdateinphase">Possession Date in Phases</label>
									<input
										class="form-control input @error('compare_data[possessions][possession_date_in_phases]') is-invalid @enderror"
										type="text" placeholder="Enter Possession Date in Phases(if phase exist)"
										value="{{(@old('compare_data')['possessions']['possession_date_in_phases']) ? (@old('compare_data')['possessions']['possession_date_in_phases']) : (@$project->compare_data->possessions->possession_date_in_phases)}}"
										name="compare_data[possessions][possession_date_in_phases]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="certificate">Occupancy Certificate Status</label>
									<input
										class="form-control input @error('compare_data[possessions][occupancy_certificate_status]') is-invalid @enderror"
										type="text"
										placeholder="Enter Certificate Status (Not Applicable, Applied, not applied, received)"
										value="{{(@old('compare_data')['possessions']['occupancy_certificate_status']) ? (@old('compare_data')['possessions']['occupancy_certificate_status']) : (@$project->compare_data->possessions->occupancy_certificate_status)}}"
										name="compare_data[possessions][occupancy_certificate_status]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="certificate">Completion Certificate Status</label>
									<input
										class="form-control input @error('compare_data[possessions][completion_certificate_status]') is-invalid @enderror"
										type="text"
										placeholder="Completion Certificate Status (Not Applicable, Not Applied, Applied, Received)"
										value="{{(@old('compare_data')['possessions']['occupancy_certificate_status']) ? (@old('compare_data')['possessions']['occupancy_certificate_status']) : (@$project->compare_data->possessions->completion_certificate_status)}}"
										name="compare_data[possessions][completion_certificate_status]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="registration">Registration of Apartments</label>
									<input
										class="form-control input @error('compare_data[possessions][registration_of_apartments]') is-invalid @enderror"
										type="text"
										placeholder="Registration of Apartments (Not Applicable, Yet to start ,Registration Started)"
										value="{{(@old('compare_data')['possessions']['registration_of_apartments']) ? (@old('compare_data')['possessions']['registration_of_apartments']) : (@$project->compare_data->possessions->registration_of_apartments)}}"
										name="compare_data[possessions][registration_of_apartments]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">
								</div>
								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="possession_descp">Possessions Description:</label>
										<textarea name="possessions_descp" id="possessions_descp"
											class="summernote">{{@$project->possessions->possessions_descp}} </textarea>
									</div>
								</div>

								<div class="col-sm-12 col-lg-6 mt-5">

								</div>
								<div class="col-12">
									<h5>Project Amenities details</h5>
								</div>
								<hr />
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="clubhousearea">Club House Area in Square Feet</label>
									<input
										class="form-control input @error('compare_data[amenities][club_house_area_in_sqft]') is-invalid @enderror"
										type="text" placeholder="Enter Club House Area in Sq ft"
										value="{{(@old('compare_data')['amenities']['club_house_area_in_sqft']) ? (@old('compare_data')['amenities']['club_house_area_in_sqft']) : (@$project->compare_data->amenities->club_house_area_in_sqft)}}"
										name="compare_data[amenities][club_house_area_in_sqft]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="openspace">Open Space including Green Space</label>
									<input
										class="form-control input @error('compare_data[amenities][open_space_including_green_space]') is-invalid @enderror"
										type="text" placeholder="Enter Open Space including Green Space"
										value="{{(@old('compare_data')['amenities']['open_space_including_green_space']) ? (@old('compare_data')['amenities']['open_space_including_green_space']) : (@$project->compare_data->amenities->open_space_including_green_space)}}"
										name="compare_data[amenities][open_space_including_green_space]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="amenities">Amenities</label>
									<input
										class="form-control input @error('compare_data[amenities][amenities]') is-invalid @enderror"
										type="text" placeholder="Enter Amenities"
										value="{{(@old('compare_data')['amenities']['amenities']) ? (@old('compare_data')['amenities']['amenities']) : (@$project->compare_data->amenities->amenities)}}"
										name="compare_data[amenities][amenities]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-2">

								</div>
								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="amenities_descp">Amenity Description:</label>
										<textarea name="amenities_descp" id="amenities_descp"
											class="summernote">{{$project->amenities->amenities_descp}} </textarea>
									</div>
								</div>

								<div class="col-sm-12 col-lg-6 mt-5">
									<div class="form-group fileInput">
										<label for="amenities">Amenity files:</label>
										<input type="file" class="form-control  @error(" media[amenities]") is-invalid
											@enderror" name="media[amenities]"
											onchange="previewImage(this, '#previewAmenitiesImage')" id="amenitiesImage">
									</div>
									@if(isset($files->amenities))
									<div class="mt-4 text-center">
										<img src="{{url('storage/'.$files->amenities)}}" alt="photo" id="previewAmenitiesImage"
											width="40%">
									</div>
									@endif
								</div>
								<div class="col-12">
									<h5>Project Developer Background details</h5>
								</div>
								<hr />
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="experience">Developer Experience in Years</label>
									<input
										class="form-control input @error('compare_data[devBackgrounds][developer_experience_in_year]') is-invalid @enderror"
										type="text" placeholder="Enter Developer Experience in Years"
										value="{{(@old('compare_data')['devBackgrounds']['developer_experience_in_year']) ? (@old('compare_data')['devBackgrounds']['developer_experience_in_year']) : (@$project->compare_data->devBackgrounds->developer_experience_in_year)}}"
										name="compare_data[devBackgrounds][developer_experience_in_year]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="deliveredprojects">Delivered Projects in Numbers</label>
									<input
										class="form-control input @error('compare_data[devBackgrounds][delivered_projects]') is-invalid @enderror"
										type="text" placeholder="Enter Delivered Projects in Numbers"
										value="{{(@old('compare_data')['devBackgrounds']['delivered_projects']) ? (@old('compare_data')['devBackgrounds']['delivered_projects']) : (@$project->compare_data->devBackgrounds->delivered_projects)}}"
										name="compare_data[devBackgrounds][delivered_projects]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="deliveries">Developers Notable Deliveries</label>
									<input
										class="form-control input @error('compare_data[devBackgrounds][developer_notable_deliveries]') is-invalid @enderror"
										type="text" placeholder="Enter Developers Notable Deliveries"
										value="{{(@old('compare_data')['devBackgrounds']['developer_notable_deliveries']) ? (@old('compare_data')['devBackgrounds']['developer_notable_deliveries']) : (@$project->compare_data->devBackgrounds->developer_notable_deliveries)}}"
										name="compare_data[devBackgrounds][developer_notable_deliveries]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
								</div>

								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="dev_backgrounds_descp">Developer Backgrounds:</label>
										<textarea name="dev_backgrounds_descp" id="dev_backgrounds_descp"
											class="summernote"> {{@$project->devBackgrounds->dev_backgrounds_descp}}</textarea>
									</div>
								</div>

								<div class="col-sm-12 col-lg-6 mt-5">

								</div>

								<div class="col-12">
									<h5>Project Pricing details</h5>
								</div>
								<hr />
								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="initialBSP">Current Price (BSP in Salable Area)</label>
									<input
										class="form-control input @error('compare_data[pricings][current_price_BSP_in_salable_area]') is-invalid @enderror"
										type="text" placeholder="Initial Price(BSP in RERA Carpet Area)"
										value="{{(@old('compare_data')['pricings']['current_price_BSP_in_salable_area']) ? (@old('compare_data')['pricings']['current_price_BSP_in_salable_area']) : (@$project->compare_data->pricings->current_price_BSP_in_salable_area)}}"
										name="compare_data[pricings][current_price_BSP_in_salable_area]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="salable">Current Price (BSP in RERA Carpet Area)</label>
									<input
										class="form-control input @error('compare_data[pricings][current_price_BSP_in_RERA_carpet_area]') is-invalid @enderror"
										type="text" placeholder="Enter Current Basic Selling Price"
										value="{{(@old('compare_data')['pricings']['current_price_BSP_in_RERA_carpet_area']) ? (@old('compare_data')['pricings']['current_price_BSP_in_RERA_carpet_area']) : (@$project->compare_data->pricings->current_price_BSP_in_RERA_carpet_area)}}"
										name="compare_data[pricings][current_price_BSP_in_RERA_carpet_area]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">
									<label for="carpet">Price Range</label>
									<input
										class="form-control input @error('compare_data[pricings][price_range]') is-invalid @enderror"
										type="text" placeholder="Enter Current Basic Selling Price According Phases"
										value="{{(@old('compare_data')['pricings']['price_range']) ? (@old('compare_data')['pricings']['price_range']) : (@$project->compare_data->pricings->price_range)}}"
										name="compare_data[pricings][price_range]" required>
								</div>

								<div class="col-sm-12 col-lg-6 mb-2">

								</div>

								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="pricings_descp">Pricings Description:</label>
										<textarea name="pricings_descp" id="pricings_descp"
											class="summernote"> {{@$project->pricings->pricings_descp}}</textarea>
									</div>
								</div>

								<div class="col-sm-12 col-lg-6 mt-5">
									<div class="form-group fileInput">
										<label for="pricings">Pricings files:</label>
										<input type="file" class="form-control  @error(" media[pricings]") is-invalid
											@enderror" name="media[pricings]"
											onchange="previewImage(this, '#previewPriceImage')" id="priceImage" >
									</div>
									@if(isset($files->pricings))
									<div class="mt-4 text-center">
										@if(!str_contains($files->pricings, 'pdf'))
										<img src="{{url('storage/'.$files->pricings)}}" alt="photo" id="previewPriceImage"
											width="40%">
										@else 
											<a href="{{url('storage/'.$files->pricings)}}" class="btn btn-primary">Download Pricings</a>
										@endif
									</div>
									@endif
								</div>

								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="advice_descp">Our Advices:</label>
										<textarea name="advices_descp" id="advices_descp" class="summernote">{{@$project->advices->advices_descp}}  
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
								  @if(!empty(json_decode($project->faqs_data)) &&
									count(json_decode($project->faqs_data))>0)
								  @foreach(json_decode($project->faqs_data) as $index =>
									$faqData)

									<div class="col-sm-12 col-lg-12 mt-2 faqData" style="padding:0 30px">
										<div class="row pt-5 pb-5" style="background:#1b577733">
											<div class="col-6">
												<label for="question">Question:</label>
												<input value="{{(@old('question')) ? (@old('question')) : (@$faqData->question)}}" name="faqs_data[{{@$index}}][question]" type="text" class="form-control" required>
											</div>
											<div class="col-6"> 
												<label for="answer">Answer:</label>
												<input  value="{{(@old('answer')) ? (@old('answer')) : (@$faqData->answer)}}"  name="faqs_data[{{@$index}}][answer]" type="text" class="form-control" required>
											</div>
                                        </div>
									    @if($index == 0)
										<span class="bg-warning plusBtnFAQ">
											<i class="fa fa-plus"></i>
										</span>
										@else
										<span class="bg-danger minusBtnFAQ">
											<i class="fa fa-minus"></i>
										</span>
										@endif
									</div>  
                                  @endforeach
								 @else
									 <div class="col-sm-12 col-lg-12 mt-2 faqData" style="padding:0 30px">
									 <div class="row pt-5 pb-5" style="background:#1b577733">
											<div class="col-6">
												<label for="question">Question:</label>
												<input  name="faqs_data[0][question]" type="text" class="form-control" required>
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
			reader.onload = function (e) {
				$(previewId).attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	// Function to re-index floor plan inputs
	function reIndexFloorPlans() {
		$('.floors .pdfloorPlans').each(function (index) {
			// Update index in input names
			$(this).find('[name^="floor_plans"]').each(function () {
				let newName = $(this).attr('name').replace(/\[\d+\]/, `[${index}]`);
				$(this).attr('name', newName);
			});
		});
	}
	//for delete the images
	$(document).on('click', '.deleteButton', function () {
		let id = $(this).attr('dataId');

		let url = "{{ url('/7439/frontend-pages/projects/edit') }}";

		var actionUrl = `${url}${id}`;
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
					},
					url: actionUrl,
					type: "GET",
					success: function (data) {
						if (data.status) {
							Swal.fire({
								title: postTitle,
								text: data.message,
								icon: 'success'
							}).then(() => {
								setTimeout(function () {
									window.location.reload();
								}, 2000);

							});
						} else {
							Swal.fire(
								postTitle,
								data.msg,
								'error'
							)
						}
					}
				});//ajax ends here
			} else {
				Swal.fire(
					'Cancelled!',
					'Your data is safe.',
					'error'
				);
			}
		})
	})

	// Plus button click event
	$('.plusBtn').click(function () {
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
	$(document).on('click', '.minusBtn', function () {
		$(this).closest('.pdfloorPlans').remove();
		reIndexFloorPlans();
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