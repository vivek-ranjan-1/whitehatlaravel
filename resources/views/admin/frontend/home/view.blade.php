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
					<form method="POST" action="{{route('home.store')}}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="page_id" value="MQ==" />
						<h4>Hero Section</h4>
						<div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Hero Text1:</label>
									<input value="{{@old('heroText') ? @old('heroText') : @$pageData['heroText']}}" type="text" class="form-control input @error('heroText') is-invalid @enderror" name="page_content[heroText]" placeholder="Hero Text">
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group"> 
									<label for="source">Hero Text2(optional):</label>
									<input  value="{{@old('complementryText') ? @old('complementryText') : @$pageData['complementryText']}}"  type="text" class="form-control input @error('complementryText') is-invalid @enderror" name="page_content[complementryText]" placeholder="Hero Text2">
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 d-flex">
								<div class="form-group fileInput mr-2">
									<label for="source">Hero Image:</label>
									<input type="file" class="form-control input @error('heroImage') is-invalid @enderror" name="page_content[heroImage]" placeholder="Hero Image" onchange="previewImage(this, '#previewHeroImage')"
											placeholder="hero Image" id="heroImage"> 
								</div>
								<div class="fileInput"> 
										<img src="{{url('storage').'/'.@$pageData['heroImage']}}" alt="photo"
											id="previewHeroImage" width="30%">
								</div>
							</div>
						</div>
						<h4 class="mt-2">Banner Section</h4>
						<div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="description">Short Description:</label>
									<textarea name="page_content[short_dscp]" rows="4" id="" class="form-control input @error('short_dscp') is-invalid @enderror">
									{{@old('short_dscp') ? @old('short_dscp') : @$pageData['short_dscp']}}
									</textarea>
								</div>
							</div>
							
							<div class="col-sm-12 col-lg-6 d-flex">
								<div class="form-group fileInput mr-2">
									<label for="source">Banner Image 1:</label>
									<input type="file" class="form-control input @error('fistBanner') is-invalid @enderror" name="page_content[fistBanner]" placeholder="Banner Image" onchange="previewImage(this, '#previewBannerImage')"
											placeholder="hero Image" id="fistBanner">
								</div>
								<div class="fileInput">
										<img src="{{url('storage').'/'.@$pageData['fistBanner']}}" alt="photo" id="previewBannerImage" width="30%">
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 d-flex">
								<div class="form-group fileInput mr-2">
									<label for="source">Banner Image 2:</label>
									<input type="file" class="form-control input @error('secondBanner') is-invalid @enderror" name="page_content[secondBanner]" value="" placeholder="Banner Image" onchange="previewImage(this, '#previewBannerImages')"
											placeholder="hero Image" id="secondBanner">
								</div>
								<div class="fileInput">
										<img src="{{url('storage').'/'.@$pageData['secondBanner']}}" alt="photo" id="previewBannerImages" width="30%">
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 d-flex">
								<div class="form-group fileInput mr-2">
									<label for="source">Banner Image 3:</label>
									<input type="file" class="form-control input @error('thirdBanner') is-invalid @enderror" name="page_content[thirdBanner]" value="" placeholder="Banner Image" onchange="previewImage(this, '#previewBannersImage')"
											placeholder="hero Image" id="thirdBanner">
								</div>
								<div class="fileInput">
										<img src="{{url('storage').'/'.@$pageData['thirdBanner']}}" alt="photo" id="previewBannersImage" width="30%">
								</div>
							</div>
						    <div class="col-sm-12 col-lg-6 d-flex mt-2">
								<div class="form-group fileInput mr-2">
									<label for="source">Banner Image 4:</label>
									<input type="file" class="form-control input @error('fourthBanner') is-invalid @enderror" name="page_content[fourthBanner]" value="" placeholder="Banner Image" onchange="previewImage(this, '#previewBanersImage')"
											placeholder="hero Image" id="fourthBanner">
								</div>
								<div class="fileInput">
										<img src="{{url('storage').'/'.@$pageData['fourthBanner']}}" alt="photo" id="previewBanersImage" width="30%">
								</div>
							</div>
						</div>
						
						<h4 class="mt-2">Mobile Banner Section</h4>
						<div class="row">
							
							<div class="col-sm-12 col-lg-6 d-flex">
								<div class="form-group fileInput mr-2">
									<label for="source">Mobile Banner Image 1:</label>
									<input type="file" class="form-control input @error('mobileFistBanner') is-invalid @enderror" name="page_content[mobileFistBanner]" placeholder="Banner Image" onchange="previewImage(this, '#previewBannerImage1')"
											placeholder="hero Image" id="mobileFistBanner">
								</div>
								<div class="fileInput">
										<img src="{{url('storage').'/'.@$pageData['mobileFistBanner']}}" alt="photo" id="previewBannerImage1" width="30%">
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 d-flex">
								<div class="form-group fileInput mr-2">
									<label for="source">Mobile Banner Image 2:</label>
									<input type="file" class="form-control input @error('mobileSecondBanner') is-invalid @enderror" name="page_content[mobileSecondBanner]" value="" placeholder="Banner Image" onchange="previewImage(this, '#previewBannerImages2')"
											placeholder="hero Image" id="mobileSecondBanner">
								</div>
								<div class="fileInput">
										<img src="{{url('storage').'/'.@$pageData['mobileSecondBanner']}}" alt="photo" id="previewBannerImages2" width="30%">
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 d-flex mt-2">
								<div class="form-group fileInput mr-2">
									<label for="source">Mobile Banner Image 3:</label>
									<input type="file" class="form-control input @error('mobileThirdBanner') is-invalid @enderror" name="page_content[mobileThirdBanner]" value="" placeholder="Banner Image" onchange="previewImage(this, '#previewBannersImage3')"
											placeholder="hero Image" id="mobileThirdBanner">
								</div>
								<div class="fileInput">
										<img src="{{url('storage').'/'.@$pageData['mobileThirdBanner']}}" alt="photo" id="previewBannersImage3" width="30%">
								</div>
							</div>
						    <div class="col-sm-12 col-lg-6 d-flex mt-2">
								<div class="form-group fileInput mr-2">
									<label for="source">Mobile Banner Image 4:</label>
									<input type="file" class="form-control input @error('mobileFourthBanner') is-invalid @enderror" name="page_content[mobileFourthBanner]" value="" placeholder="Banner Image" onchange="previewImage(this, '#previewBanersImage4')"
											placeholder="hero Image" id="mobileFourthBanner">
								</div>
								<div class="fileInput">
										<img src="{{url('storage').'/'.@$pageData['mobileFourthBanner']}}" alt="photo" id="previewBanersImage4" width="30%">
								</div>
							</div>
						</div>
					   <h4 class="mt-2">banner Links</h4>
					   <div class="row">
						
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label for="links">Second Banner Link:</label>
								<input value="{{@old('second_link') ? @old('second_link') : @$pageData['second_link']}}" type="text" name="page_content[second_link]" id="page_content[second_link]" class="form-control input">
							</div>	
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label for="links">Third Banner Link:</label>
								<input value="{{@old('third_link') ? @old('third_link') : @$pageData['third_link']}}" type="text" name="page_content[third_link]" id="page_content[third_link]" class="form-control input">
							</div>	
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label for="links">Fourth Banner Link:</label>
								<input value="{{@old('fourth_link') ? @old('fourth_link') : @$pageData['fourth_link']}}" type="text" name="page_content[fourth_link]" id="page_content[fourth_link]" class="form-control input">
							</div>	
						</div>
						
					  </div>
						
						<h4 class="mt-2">Featured Projects</h4>
						<div class="row">
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="description">Short Description:</label>
									<textarea name="page_content[short_dscps]" rows="5" id="" class="form-control input @error('short_dscps') is-invalid @enderror">
									{{@old('short_dscp') ? @old('short_dscp') : @$pageData['short_dscp']}}
									</textarea>
								</div>
							</div>
							
							
						</div>
						<h4 class="mt-2">Post Your Property Section</h4>
						<div class="row">
						    <div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Title:</label>
									<input type="text" class="form-control input @error('title') is-invalid @enderror" name="page_content[propertyTitle]" value="{{@old('propertyTitle') ? @old('propertyTitle') : @$pageData['propertyTitle']}}" placeholder="Enter Title" >
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 d-flex">
								<div class="form-group fileInput mr-2">
									<label for="source">GIF:</label>
									<input type="file" class="form-control input @error('propertyGif') is-invalid @enderror" name="page_content[propertyGif]" onchange="previewImage(this, '#previewPropertyGif')" placeholder="featured Image" id="propertyGif">
								</div>
								<div class="fileInput">
										<img src="{{url('storage').'/'.@$pageData['propertyGif']}}" alt="photo" id="previewPropertyGif" width="30%">
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="description">Short Description:</label>
									<textarea name="page_content[propertyDescp]" rows="4" id="" class="form-control input @error('dscps') is-invalid @enderror">
									{{@old('propertyDescp') ? @old('propertyDescp') : @$pageData['propertyDescp']}}
									</textarea>
								</div>
							</div>
						</div>
						<h4 class="mt-2">Real Estate Links</h4>
						<div class="row">
						    <div class="col-12 col-sm-6">
							    <div class="form-group">
									<label for="links">Links:</label>
									<textarea name="page_content[footerLinks]" id="links" class="summernote">
									 {{@old('footerLinks') ? @old('footerLinks') : @$pageData['footerLinks']}}
									</textarea>
								</div>	
							</div>
						</div>
						
						
						<h4 class="mt-2">SEO Section</h4>
						<div class="row">
						    <div class="col-12 col-sm-6">
							    <div class="form-group">
									<label for="links">Title :</label>
									<input value="{{@old('title') ? @old('title') : @$seoData['title']}}" type="text" name="seo_data[title]" id="seo_data[title]" class="form-control input" >
								</div>	
							</div>
							<div class="col-12 col-sm-6">
							    <div class="form-group">
									<label for="links">Meta Tags :</label>
									<input value="{{@old('meta_tags') ? @old('meta_tags') : @$seoData['meta_tags']}}" type="text" name="seo_data[meta_tags]" id="seo_data[meta_tags]" class="form-control input">
								</div>	
							</div>
							
							<div class="col-12 col-sm-6">
							    <div class="form-group">
									<label for="links">Keywords :</label>
									<input value="{{@old('keywords') ? @old('keywords') : @$seoData['keywords']}}" type="text" name="seo_data[keywords]" id="seo_data[keywords]" class="form-control input">
								</div>	
							</div>
							
							<div class="col-12 col-sm-6">
							    <div class="form-group">
									<label for="links">Canonical Links :</label>
									<input value="{{@old('canonical_links') ? @old('canonical_links') : @$seoData['canonical_links']}}" type="text" name="seo_data[canonical_links]" id="seo_data[canonical_links]" class="form-control input">
								</div>	
							</div>
							
							<div class="col-12 col-sm-6">
							    <div class="form-group">
									<label for="links">Image Alt Tag :</label>
									<input value="{{@old('alt_tag') ? @old('alt_tag') : @$seoData['alt_tag']}}" type="text" name="seo_data[alt_tag]" id="seo_data[alt_tag]" class="form-control input">
								</div>	
							</div>
							
							<div class="col-12 col-sm-12">
							    <div class="form-group">
									<label for="links">Meta Description :</label>
									<textarea class="form-control input" name="seo_data[meta_descriptions]" id="seo_data[meta_descriptions]">
									{{@old('meta_descriptions') ? @old('meta_descriptions') : @$seoData['meta_descriptions']}}</textarea>
								</div>	
							</div>
						</div>
						
						<h4 class="mt-2">Social Links</h4>
					   <div class="row">
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label for="links">LinkedIn Link:</label>
								<input value="{{@old('linkedin') ? @old('linkedin') : @$pageData['linkedin']}}" type="text" name="page_content[linkedin]" id="page_content[linkedin]" class="form-control input">
							</div>	
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label for="links">X Link:</label>
								<input value="{{@old('twitter') ? @old('twitter') : @$pageData['twitter']}}" type="text" name="page_content[twitter]" id="page_content[twitter]" class="form-control input">
							</div>	
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label for="links">YouTube Link:</label>
								<input value="{{@old('youtube') ? @old('youtube') : @$pageData['youtube']}}" type="text" name="page_content[youtube]" id="page_content[youtube]" class="form-control input">
							</div>	
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label for="links">Instagram Link:</label>
								<input value="{{@old('instagram') ? @old('instagram') : @$pageData['instagram']}}" type="text" name="page_content[instagram]" id="page_content[instagram]" class="form-control input">
							</div>	
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label for="links">Facebook Link:</label>
								<input value="{{@old('facebook') ? @old('facebook') : @$pageData['facebook']}}" type="text" name="page_content[facebook]" id="page_content[facebook]" class="form-control input">
							</div>	
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label for="links">Pinterest Link:</label>
								<input value="{{@old('pinterest') ? @old('pinterest') : @$pageData['pinterest']}}" type="text" name="page_content[pinterest]" id="page_content[pinterest]" class="form-control input">
							</div>	
						</div>
					  </div>
                      <h4 class="mt-2">Ads Section:</h4>	
                        <div class="row">
					      <div class="col-12 col-sm-6">  
						    <div class="form-group">
								<label for="links">ADS Title:</label>
								<input value="{{@old('ads_title') ? @old('ads_title') : @$pageData['ads_title']}}" type="text" name="page_content[ads_title]" id="page_content[ads_title]" class="form-control input" placeholder="Enter ADS Title">
							</div>	
						  </div>
						  <div class="col-12 col-sm-6">  
						    <div class="form-group">
								<label for="links">ADS URL:</label>
								<input value="{{@old('ads_url') ? @old('ads_url') : @$pageData['ads_url']}}" type="text" name="page_content[ads_url]" id="page_content[ads_url]" class="form-control input" placeholder="Enter ADS URL">
							</div>	
						  </div>
						    <div class="col-12 col-sm-6">
							    <div class="form-group">
									<label for="links">ADS Description :</label>
									<textarea class="form-control input" name="page_content[ads_descriptions]" id="page_content[ads_descriptions]">
									{{@old('ads_descriptions') ? @old('ads_descriptions') : @$pageData['ads_descriptions']}}</textarea>
								</div>	
							</div>
							<div class="col-sm-12 col-lg-6 d-flex">
								<div class="form-group fileInput mr-2">
									<label for="source">ADS Image:</label>
									<input type="file" class="form-control input @error('ads_images') is-invalid @enderror" name="page_content[ads_images]" onchange="previewImage(this, '#previewAdsImages')" placeholder="featured Image" id="ads_images">
								</div>
								<div class="fileInput">
										<img src="{{url('storage').'/'.@$pageData['ads_images']}}" alt="photo" id="previewAdsImages" width="30%">
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