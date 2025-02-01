@extends('layouts.admin-app')

@section('title', $title)

@section('customCss')
<link rel="stylesheet" href="{{url('assets/customs/css/projects.css')}}">
@endsection
<style>
input[type="checkbox"]{
  -ms-transform: scale(1.5); /* IE */
 -moz-transform: scale(1.5); /* FF */
 -webkit-transform: scale(1.5); /* Safari and Chrome */
 -o-transform: scale(1.5); /* Opera */
  padding: 7px;
  margin:10px;
}
</style>

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            {!! $breadcrumbHtml !!}

            <div class="contentCard projects">
               <div class="card">
			        <div class="card-body">
                        <form method="POST" action="{{route('blogs.store')}}" enctype="multipart/form-data"> 
							@csrf
					        <div class="row">
								<div class="col-sm-12 col-lg-6 mb-4">
								  <label for="title">Title</label>
									<input class="form-control input @error('title') is-invalid @enderror " type="text" placeholder="Enter Blog title" value="{{@old('title')}}" name="title" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
								    <label for="short_description">Short Description</label>
									<input class="form-control input @error('short_description') is-invalid @enderror " type="text" placeholder="Enter Blog Short Description" value="{{@old('short_description')}}" name="short_description" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-4">
								  <label for="primary_keyword">Primary Keyword</label>
									<input class="form-control input @error('seo_data[primary_keyword]') is-invalid @enderror " type="text" placeholder="Enter Blog Primary Keyword" value="{{@old('seo_data')['primary_keyword']}}" name="seo_data[primary_keyword]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
								  <!--<label for="secondary_keyword">Secondary Keyword</label>-->
								  <label for="secondary_keyword">Blog Title</label>
									<!--<input class="form-control input @error('seo_data[secondary_keyword]') is-invalid @enderror " type="text" placeholder="Enter Blog Secondary Keyword" value="{{@old('seo_data')['secondary_keyword']}}" name="seo_data[secondary_keyword]" required>-->
									<input class="form-control input @error('seo_data[secondary_keyword]') is-invalid @enderror " type="text" placeholder="Enter Blog Title" value="{{@old('seo_data')['secondary_keyword']}}" name="seo_data[secondary_keyword]" required>
								</div>
								<div class="col-sm-12 col-lg-6 mb-4">
								  <label for="meta_description">Meta Description</label>
									<input class="form-control input @error('seo_data[meta_description]') is-invalid @enderror " type="text" placeholder="Enter Blog Meta Description" value="{{@old('seo_data')['meta_description']}}" name="seo_data[meta_description]" required>
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-4">
								  <label for="canonical_link">Canonical Link</label>
									<input class="form-control input @error('seo_data[canonical_link]') is-invalid @enderror " type="text" placeholder="Enter Canonical Link" value="{{@old('seo_data')['canonical_link']}}" name="seo_data[canonical_link]" required> 
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-4">
								  <label for="alt_tag">Image Alt Tag</label>
									<input class="form-control input @error('seo_data[alt_tag]') is-invalid @enderror " type="text" placeholder="Enter Image Alt Tag" value="{{@old('seo_data')['alt_tag']}}" name="seo_data[alt_tag]" required>   
								</div>
								
								<div class="col-sm-12 col-lg-6 mb-4">
								  <label for="slug">Slug</label>
									<input class="form-control input @error('slug') is-invalid @enderror " type="text" placeholder="Enter Slug" value="{{@old('slug')}}" name="slug" required>     
								</div>
								
								<div class="col-sm-12 col-lg-6 mt-3">
									<div class="form-group">
										<label for="description">Description:</label>
										<textarea name="description" id="blogSummernote" class="blogSummernote">
										{{@old('description')}}
										</textarea>
									</div>
								</div>
								<div class="col-sm-12 col-lg-6 d-flex mb-4"> 
									<div class="form-group fileInput mr-2">
										<label for="thumbnail">Featured Image:</label> 
										<input type="file" class="form-control @error('featured_image') is-invalid @enderror" name="featured_image" onchange="previewImage(this, '#previewFeaturedImage')" placeholder="Project Featured Image" id="featured_image" required>	
									</div>
									 <div class="fileInput">
										<img src="/../../assets/images/NA.webp" alt="photo"  id="previewFeaturedImage"> 
									</div>
								</div>
								
								<div class="col-12 mt-3">
									<input type="checkbox" name="status" checked="checked">
									Make this blog active.
								</div>
								<div class="col-12 mt-3">
									<button type="submit" class="btn btn-primary">Upload Blog</button>
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
			reader.onload = function(e) {
				$(previewId).attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]); 
		}
	}
</script>
@endsection