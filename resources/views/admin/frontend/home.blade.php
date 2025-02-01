@extends('layouts.admin-app')

@section('title', $title)

@section('customCss')
<link rel="stylesheet" href="{{url('assets/customs/css/youtube-video.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            {!! $breadcrumbHtml !!}

            <div class="card contentCard">
                <div class="card-body">
					<form method="POST" action="{{route('hero-section.store')}}" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<h3>Hero Section</h3> 
								<hr/>
								<div class="form-group">
									<label for="source">Title:</label>
									<input type="text" class="form-control input @error('title') is-invalid @enderror" name="title" value="{{@$heroSectionData->title}}" placeholder="Hero Section Title" required>
								</div>
								
								<div class="form-group">
									<label for="description">Note:</label>
									<textarea name="note" rows="5" id="" class="form-control input @error('note') is-invalid @enderror">{{@$heroSectionData->note}}</textarea>
								</div><br>
							</div>
							<div class="col-md-6">
								 <div class="mb-5 fileInput">
                                     <img src="" alt="photo"  id="previewThumbnail"> 
                                </div>
								<div class="form-group fileInput">
									<label for="thumbnail">Upload Hero Image:</label>
									<input type="file" class="form-control  @error('image') is-invalid @enderror" name="hero_image" placeholder="Hero Image" id="thumbnail" required>	
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary">Create Now</button>
							</div>
						</div>
                    </form>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="card contentCard">
						<div class="card-body">
							<form method="POST" action="{{route('sliders.store')}}" enctype="multipart/form-data">
							@csrf
							<h3>Sliders</h3><hr>
								<div class="form-group">
									<label for="source">Title:</label>
									<input type="text" class="form-control input @error('title') is-invalid @enderror" name="title" placeholder="Slider Title" required>
								</div>
								
								<div class="mb-2 fileInput developerLogoInputs"> 
									<img width="20%" src="" alt="photo" id="previewSlider">
								</div>
								<br>
								<b>Upload Developer Logo:</b>
								<div class="form-group fileInput sliderInputs">
									<input type="file" class="form-control"
										name="image" placeholder="Developer Logo" id="slider" required>
								</div>
								<div class="col-12">
									<button type="submit" class="btn btn-primary">Create Now</button>
								</div>		
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="row">
					@if(!empty($sliders) && count($sliders)>0)
						@foreach($sliders as $slider)
						<div class="col-sm-12 col-md-6">
							<a href="{{ url('7439/frontend-pages/home/sliders/delete/').'/'.base64_encode($slider->id) }}" style="float:right; position:relative;top:20px; left:-20px; z-index:100;">
												<i class="fas fa-times" aria-hidden="true"></i>
										</a>
							<img src="{{url('storage/'.$slider->image)}}" width="100%">
						</div>
						@endforeach
					@endif
					</div>
				</div>
			</div>
			
			<br>
			<br>
			<div class="card contentCard">
                <div class="card-body">
					<form method="POST" action="{{route('three-value-system.store')}}" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<h3>Three Value System</h3> 
								<hr/>
								<div class="form-group">
									<label for="source">Title:</label>
									<input type="text" class="form-control input @error('title') is-invalid @enderror" name="title" value="" placeholder="Value System Title" required>
								</div>
								
								<div class="form-group">
									<label for="description">Description:</label>
									<textarea name="description" rows="5" id="" class="form-control input @error('description') is-invalid @enderror"></textarea>
								</div><br>
								<div class="form-group">
									<label for="source">Video:</label>
									<input type="file" class="form-control input @error('video') is-invalid @enderror" name="video" value="" placeholder="Value System Video" required>
								</div>
							</div>
							<div class="col-md-6">
								 <div class="mb-5 fileInput">
                                     <img src="" alt="photo"  id="previewThreeValueSystem" width='20%'> 
                                </div>
								<div class="form-group fileInput">
									<label for="image">Upload Image:</label>
									<input type="file" class="form-control  @error('image') is-invalid @enderror" name="image" placeholder="Value System Image" id="threeValueSystem" required>	
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary">Create Now</button>
							</div>
						</div>
                    </form>
				</div>
			</div>
			<br>
			<div class="card contentCard">
                <div class="card-body">
					<form method="POST" action="{{route('two-value-system.store')}}" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<h3>Two Value System</h3> 
								<hr/>
								<div class="form-group">
									<label for="source">Title:</label>
									<input type="text" class="form-control input @error('title') is-invalid @enderror" name="title" value="" placeholder="Value System Title" required>
								</div>
								
								<div class="form-group">
									<label for="description">Description:</label>
									<textarea name="description" rows="5" id="" class="form-control input @error('description') is-invalid @enderror"></textarea>
								</div><br>
							</div>
							<div class="col-md-6">
								 <div class="mb-5 fileInput">
                                     <img src="" alt="photo"  id="previewTwoValueSystem" width='20%'> 
                                </div>
								<div class="form-group fileInput">
									<label for="image">Upload Image:</label>
									<input type="file" class="form-control  @error('image') is-invalid @enderror" name="image" placeholder="Value System Image" id="twoValueSystem" required>	
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary">Create Now</button>
							</div>
						</div>
                    </form>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="card contentCard">
						<div class="card-body">
							<form method="POST" action="{{route('tool-insights.store')}}" enctype="multipart/form-data">
							@csrf
							<h3>Tools Insights</h3><hr>
								<div class="form-group">
									<label for="source">Title:</label>
									<input type="text" class="form-control input @error('title') is-invalid @enderror" name="title" placeholder="Tools Title" required>
								</div>
								<div class="form-group">
									<label for="source">Url:</label>
									<input type="text" class="form-control input @error('url') is-invalid @enderror" name="url" placeholder="Tools URL" required>
								</div>
								
								<b>Upload icon:</b>
								<div class="form-group">
									<input type="file" class="form-control"
										name="icon" placeholder="upload icon" id="icon" required>
								</div>
								<div class="form-group">
									<label for="source">Short Note:</label>
									<textarea class="form-control" name="description" placeholder="write a short note"></textarea>
								</div>
								<div class="col-12">
									<button type="submit" class="btn btn-primary">Create Now</button>
								</div>		
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					  <div class="row">
						@if(!empty($insights) && count($insights) > 0)
							@foreach($insights as $insight)
								<div class="col-md-4 col-sm-6 p-1">
									<a href="javascript:void(0)" dataId="{{base64_encode($insight->id)}}" class="deleteButton" style="float:right; position:relative;top:10px; left:-20px; z-index:100;">
										<i class="fas fa-times" aria-hidden="true"></i>
									</a>
									<div class="card text-center">
										<div class="card-header text-center">
										  <img class="m-auto" src="{{url('storage/' . $insight->icon)}}" width="30px">
										</div>
										<div class="card-body text-center"><h5 class="text-bold">{{$insight->title}}</h5>
										  <p class="text-justify p-1">{{$insight->description}}</p>
                                        </div> 
									</div>
								</div>
							@endforeach
						@endif
					   </div>
				</div>	
			</div>
			<br>
			<br>
			
			<!--developer logo-->
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="card contentCard">
						<div class="card-body">
							<form method="POST" action="{{route('developer-logo.store')}}" enctype="multipart/form-data">
									@csrf                                   
									   <h3>Developer Logo</h3>
										<hr />
										<div class="form-group">
											<label for="source">Title:</label>
											<input type="text"
												class="form-control"
												name="title" placeholder="Developer Logo Title" required>
										</div>
										<div class="mb-2 fileInput developerLogoInputs"> 
											<img width="20%" src="" alt="photo" id="previewDeveloperLogo">
										</div>
										<br>
										<b>Upload Developer Logo:</b>
										<div class="form-group fileInput developerLogoInputs">
											<input type="file" class="form-control"
												name="image" placeholder="Developer Logo" id="developerLogo" required>
										</div>
									<div class="col-12">
										<button type="submit" class="btn btn-primary">Create Now</button>
									</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
						<div class="row">
						@if(!empty($developerLogos) && count($developerLogos) > 0)
							@foreach($developerLogos as $logo)
								<div class="col-md-4 col-sm-6 p-1">
									<a href="{{ url('7439/frontend-pages/home/developer-logo/delete/').'/'.base64_encode($logo->id) }}" style="float:right; position:relative;top:10px; left:-20px; z-index:100;">
										<i class="fas fa-times" aria-hidden="true"></i>
									</a>
									<div class="card text-center">
										<img class="m-auto" src="{{url('storage/' . $logo->image)}}" width="80%">
									</div>
								</div>
							@endforeach
						@endif
						</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection

@section('customJs')
<script>
previewThumbnail.src = '{{ $heroSectionData ? url("/storage/" . $heroSectionData->hero_image) : "../../assets/images/NA.webp" }}';


thumbnail.onchange = evt => {
    const [file] = thumbnail.files;
    if (file) {
        previewThumbnail.src = URL.createObjectURL(file);
    } else {
        previewThumbnail.src = '../../assets/images/NA.webp';
    }
}


previewDeveloperLogo.src = "../../assets/images/NA.webp";
developerLogo.onchange = evt => {
    const [file] = developerLogo.files;
	previewDeveloperLogo.src = (file) ? URL.createObjectURL(file) : '../../assets/images/NA.webp';
}

previewSlider.src = "../../assets/images/NA.webp";
slider.onchange = evt => {
    const [file] = slider.files;
	previewSlider.src = (file) ? URL.createObjectURL(file) : '../../assets/images/NA.webp';
}

previewTwoValueSystem.src = "../../assets/images/NA.webp";
twoValueSystem.onchange = evt => {
    const [file] = twoValueSystem.files;
	previewTwoValueSystem.src = (file) ? URL.createObjectURL(file) : '../../assets/images/NA.webp';
}

previewThreeValueSystem.src = "../../assets/images/NA.webp";
threeValueSystem.onchange = evt => {
    const [file] = threeValueSystem.files;
	previewThreeValueSystem.src = (file) ? URL.createObjectURL(file) : '../../assets/images/NA.webp';
}
 
	
	$(document).on('click','.deleteButton',function(){
		let id = $(this).attr('dataId');
		
		let url = "{{ url('/7439/frontend-pages/home') }}"; 
		
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
                    type:"GET",
                    success: function(data){
                      if(data.status){
                        Swal.fire({
                          title : postTitle,
                          text : data.message,
                          icon : 'success'
                        }).then(() => {
							setTimeout(function(){
							   window.location.reload();
							}, 2000);

                        });
                      }else{
                        Swal.fire(
                          postTitle,
                          data.msg,
                          'error'
                        )
                      }
                    }
                  });//ajax ends here
            }else{
				Swal.fire(
                    'Cancelled!',
                    'Your data is safe.',
                    'error'
                  );
			}
        })
	})

</script>

@endsection