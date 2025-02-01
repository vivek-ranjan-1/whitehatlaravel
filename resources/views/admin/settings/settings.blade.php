@extends('layouts.admin-app')

@section('title', $title)

@section('customCss')
@endsection

@section('content')

<a href="down">Put Website into Maintainance Mode</a>

<div class="row">
		<div class="col-md-12">
			{!! $breadcrumbHtml !!}
			<div class="card contentCard">
				<div class="card-body">
					<form method="POST" action="" enctype="multipart/form-data">
						@csrf
						<h4>Credentials Section</h4>
						<div class="row">
						    <div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Social Media Name:</label>
									<input type="text" class="form-control input @error('social_media_name') is-invalid @enderror"
										name="social_media_name" placeholder="Enter Social Media Name" >
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Client ID:</label>
									<input type="text" class="form-control input @error('client_id') is-invalid @enderror"
										name="client_id" placeholder="Client ID">
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Client Secret:</label>
									<input type="text" class="form-control input @error('client_secret') is-invalid @enderror"
										name="client_secret" placeholder="Enter Client Secret" >
								</div>
							</div>
							<div class="col-12 col-sm-6">
								
							</div>
							
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
					
				</div>
				
				<div class="card-body">
					<form method="POST" action="{{route('credentials.store')}}">
						@csrf
						<h4>Credentials Section</h4>
						<div class="row">
						    <div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Social Media Name:</label>
									<input type="text" class="form-control input @error('social_media_name') is-invalid @enderror"
										name="social_media_name" placeholder="Enter Social Media Name" value="{{$credentials->social_media_name}}">
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Client ID:</label>
									<input type="text" class="form-control input @error('client_id') is-invalid @enderror"
										name="client_id" placeholder="Client ID" value="{{$credentials->client_id}}">
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="form-group">
									<label for="source">Client Secret:</label>
									<input type="text" class="form-control input @error('client_secret') is-invalid @enderror"
										name="client_secret" placeholder="Enter Client Secret" value="{{$credentials->client_secret}}">
								</div>
							</div>
							<div class="col-12 col-sm-6">
								
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

@endsection