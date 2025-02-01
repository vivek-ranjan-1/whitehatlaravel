@extends('layouts.admin-app')

@section('title', $title)

@section('customCss')
<link rel="stylesheet" href="{{url('assets/customs/css/dashboard.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
		<div class="col-md-12">
			{!! $breadcrumbHtml !!}
		</div>
		
    </div>
    <div class="row justify-content-center">
		<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<p style="font-weight:600;margin-bottom:0">Change Password</p>
			</div>
			<div class="card-body">
				<form class="p-3">
				
					<div class="form-group">
						<label for="password">Old Password</label>
						<input class="form-control" type="password" name="oldPassword" required>
						 @error('oldPassword')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					
					<div class="form-group">
						<label for="password">New Password</label>
						<input class="form-control pass-strength" type="password" name="newPassword" required>
						<div class="pwstrength_viewport_progress"></div>
						<code>Password length should be between 8 to 15 characters.</code>
						@error('newPassword')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					
					<div class="form-group">
						<label for="password">Confirm Password</label>
						<input class="form-control" type="password" name="confirmPassword" required>
						 @error('confirmPassword')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror

						<small class="confirm_password"></small>
					</div>
					
					<button class="btn btn-info" type="submit">Change Password</button>
				</form>
			
			</div>
		</div>
			
		</div>
	</div>
</div>
@endsection

@section('customJs')
	<script>
		// password strength
        var pass_options = {};
        pass_options.ui = {
          showVerdictsInsideProgressBar: true,
          viewports: {
            progress: ".pwstrength_viewport_progress"
          }
        };
        pass_options.common = {
          debug: false
        };
        $('.pass-strength').pwstrength(pass_options);
	</script>
@endsection