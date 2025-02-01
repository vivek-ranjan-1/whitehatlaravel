@extends('layouts.admin-app')

@section('title', $title)

@section('customCss')
<link rel="stylesheet" href="{{url('assets/customs/css/youtube-video.css')}}">
<link rel="stylesheet" href="{{url('assets/customs/css/projects.css')}}">
@endsection

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			{!! $breadcrumbHtml !!}
			<div class="card contentCard">
				<div class="card-body">
					<form method="POST" action="{{route('message.store')}}" enctype="multipart/form-data">
						@csrf
						<h4>Newsletter Section</h4>
						<div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Festival Title:</label>
									<input type="text" class="form-control input @error('title') is-invalid @enderror"
										name="title" placeholder="Festival Title" value="{{@$message->title}}">
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Time:</label>
									<input type="time" class="form-control input @error('time') is-invalid @enderror"
										name="time" placeholder="Enter Time"  value="{{@$message->time}}">
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Date:</label>
									<input type="date" class="form-control input @error('date') is-invalid @enderror"
										name="date" placeholder="Enter Date"  value="{{@$message->date}}">
								</div>
							</div>
							<div class="col-12 col-sm-6">
								
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="message">Message:</label>
									<textarea name="message" rows="4" id=""
										class="form-control input @error('message') is-invalid @enderror">
										 {{@$message->message}}
									</textarea>
								</div>
							</div>
							
							<div class="col-sm-12 col-lg-6 d-flex">
								<div class="form-group fileInput mr-2">
									<label for="source">Image:</label>
									<input type="file"
										class="form-control input @error('image') is-invalid @enderror"
										name="image" placeholder="Image"
										onchange="previewImage(this, '#previewImage')" placeholder="Image"
										id="image">
								</div>
								<div class="fileInput">
									<img src="/../../assets/images/NA.webp" alt="photo"
										id="previewImage" width="30%">
								</div>
							</div>
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
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
</script>
@endsection
