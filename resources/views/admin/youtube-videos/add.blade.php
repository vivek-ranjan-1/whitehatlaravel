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
                    <form method="POST" action="{{route('youtube-videos.store')}}" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="source">Video Source:</label>
									<input type="text" class="form-control input @error('video_source') is-invalid @enderror" name="video_source" placeholder="Video Source">
								</div>
								<div class="form-group">
									<label for="title">Title:</label>
									<input type="text" class="form-control input @error('title') is-invalid @enderror" name="title" placeholder="Title">
								</div>
								<div class="form-group">
									<label for="description">Video Description:</label>
									<textarea name="description" rows="5" id="" class="form-control input @error('description') is-invalid @enderror"></textarea>
								</div><br>
							</div>
							<div class="col-md-6">
								 <div class="mb-5 fileInput">
                                    <img src="images/retail-shop.webp" alt="photo"  id="previewThumbnail"> 
                                </div>
								<div class="form-group fileInput">
									<label for="thumbnail">Video Thumbnail:</label>
									<input type="file" class="form-control  @error('thumbnail') is-invalid @enderror" name="thumbnail" placeholder="Thumbnail" id="thumbnail">	
								</div>
							</div>
							<div class="col-12">
							<button type="submit" class="btn btn-primary">Create Now</button>
							</div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
previewThumbnail.src = '../../assets/images/NA.webp';
thumbnail.onchange = evt => {
  const [file] = thumbnail.files
  if (file) {
    previewThumbnail.src = URL.createObjectURL(file)
  }
}
</script>
@endsection

