@extends('layouts.admin-app')
@section('title', $title)
@section('customCss')
<link rel="stylesheet" href="{{url('assets/customs/css/settings.css')}}">
@endsection
@section('content') 
<div class="container-fluid">
	<div class="row">		
		{!! $breadcrumbHtml !!} 
		
		<div class="card contentCard my-3 permissions">
			<div class="card-header">
				<a class="btn btn-primary pt-2 float-right" href="{{route('modules.add')}}">
					<span class="fa fa-plus"></span> Add Module
				</a>
			</div>
			<div class="card-body">
				<div class="container">
						<div class="row align-tems-center border-bottom">
							<div class="col-3 text-uppercase d-flex border-right  py-3">
								<div style="transform:rotate(270deg); height:0; margin-top:10px">
									<i class="fa-solid fa-arrow-left-long"></i><br>
									Modules
								</div>
								<div class="text-right" style="position:relative;top:-20px"><i class="fa-solid fa-arrow-right-long"></i><br>Operations</div>
							</div>
							<div class="col-9 d-flex justify-content-between  text-uppercase  text-center  py-3">
								<div class="w-100 text-center">
									<input type="checkbox" id="select_c_all">
									Create
								</div>
								<div class="w-100 text-center">
									<input type="checkbox" id="select_r_all">
									Read
								</div>
								<div class="w-100 text-center">
								<input type="checkbox" id="select_u_all">
								Update
								</div>
								<div class="w-100 text-center"><input type="checkbox" id="select_d_all">Delete</div>
								<div class="w-100 text-center"><input type="checkbox" id="select_f_all">Force Delete</div>
							</div>
						</div>
					@if(!empty($modules) && count($modules)>0)
						@foreach($modules as $module)
						<div class="row border-bottom">
							<div class="col-3  py-5 text-capitalize border-right">
							<div class="text-uppercase ml-5">{{$module->name}}</div>
							</div>
							<div class="col-9 text-capitalize  d-flex justify-content-between align-items-center">
								<div class="w-100 text-center">
									<input type="checkbox" class="createCheckBoxes" name="permissions" {{(userPermissions('create', $module->id)? 'checked' : '' )}} value="{{'permissions['.base64_encode($module->id).'][create]'}}" />
									

								</div>
								<div class="w-100 text-center">
									<input type="checkbox" class="readCheckBoxes" name="permissions" value="{{'permissions['.base64_encode($module->id).'][read]'}}"{{(userPermissions('read', $module->id)? 'checked' : '' )}} />
								</div>
								<div class="w-100 text-center">
									<input type="checkbox" name="permissions" class="updateCheckBoxes"  value="{{'permissions['.base64_encode($module->id).'][update]'}}" {{(userPermissions('update', $module->id)? 'checked' : '' )}} />
								</div>
								<div class="w-100 text-center">
									<input type="checkbox" name="permissions"  class="deleteCheckBoxes"  value="{{'permissions['.base64_encode($module->id).'][delete]'}}" {{(userPermissions('delete', $module->id)? 'checked' : '' )}} />
								</div>
								<div class="w-100 text-center">
									<input type="checkbox" name="permissions" class="fdCheckBoxes"  value="{{'permissions['.base64_encode($module->id).'][permanent-delete]'}}" {{(userPermissions('permanent-delete', $module->id)? 'checked' : '' )}} />
								</div>
							</div>
						</div>
						@endforeach
					@endif
					<button class="btn btn-primary mt-3"id="updatePermissionBtn">Update Permission</button>
				</div>
			</div>
		</div>
		
		<div class="card contentCard my-3">
			<div class="card-body">
				<form method="POST" action="{{route('users.store')}}">
					@csrf
					<h4>Add Users</h4>
					<div class="row">
						
						<div class="col-12 col-sm-6 my-3">
							<input type="text" class="form-control input @error('name') is-invalid @enderror"
										name="name" placeholder="Enter user Name" value="{{old('name')}}">
						</div>
						
						<div class="col-12 col-sm-6 my-3">
							<input type="email" class="form-control input @error('email') is-invalid @enderror"
										name="email" placeholder="Enter user Email" value="{{old('email')}}">
						</div>
						
						<div class="col-12 col-sm-6 my-3">
							<input type="password" class="form-control input @error('password') is-invalid @enderror"
										name="password" placeholder="Enter user Name">
						</div>
						<div class="col-12 col-sm-6 my-3">
							<select name="role_id" class=" form-control">
								<option disabled>--Select Option---</option>
								@if(!empty($roles) && count($roles)>0)
									@foreach($roles as $role)
										<option value="{{$role->id}}">{{$role->role_name}}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="col-12 col-sm-6 my-3">
							<button class="btn btn-primary">ADD NOW</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="card contentCard my-3">
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
			<div class="card contentCard my-3">
				<div class="card-body d-flex justify-content-between">
					<div>
						<h5>Shut Down The Website</h5>
					</div>
					<div>
						 <input id="checkboxInput" type="checkbox" value="{{$organization->repair_mode}}" {{ $organization->repair_mode ? 'checked' : '' }}>
						<label class="toggleSwitch" for="checkboxInput">
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('customJs')
<script>
	$("#checkboxInput").on("change",function(){
		var mode = $(this).val();
		Swal.fire({
                icon: 'question',
                title: 'Are You Sure?',
                text: 'Once Continue, The site will be gone down. ',
                showCancelButton: true,
                confirmButtonColor: '#1b5577',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continue'
            }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    headers: {
					'X-CSRF-TOKEN': '{{csrf_token()}}'
					},
                    url: "{{route('settings.change-mode')}}",     
                    type:"GET",
                    success: function(data){
                      if(data.status){
                        Swal.fire({
                          title : 'Success',
                          text : data.message,
                          icon : 'success'
                        }).then(() => {
                          $("#checkboxInput").value(`${data.mode}`);
						  $('#checkboxInput').prop('checked', `${data.mode}`);
                        });
                      }else{
                        Swal.fire(
                          postTitle,
                          data.msg,
                          'error'
                        );
						$('#checkboxInput').prop('checked', mode);
                      }
                    }
                  });
                }else{
					$('#checkboxInput').prop('checked', (mode==0)?false:true);
                  Swal.fire(
                    'Cancelled!',
                    'Your data is safe.',
                    'error'
                  );
					
                }
            });
	});
	
	$("#updatePermissionBtn").on("click", function(){
		Swal.fire({
                icon: 'question',
                title: 'Are You Sure?',
                text: 'Once Continue, The permission will be changed. ',
                showCancelButton: true,
                confirmButtonColor: '#1b5577',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continue'
            }).then((result) => {
                if (result.isConfirmed) {  

					var checkedBoxes = $('input[name="permissions"]:checked');
					const checkedValues = Array.from(checkedBoxes).map(checkbox => checkbox.value);
					const roleId = 'MQ==';
					// Make the AJAX call to submit the form
					$.ajax({
						headers: {
							'X-CSRF-TOKEN': '{{csrf_token()}}'
						},
						url: '{{route("permissions.store")}}', // Replace with the actual URL to send the request to
						type: 'POST',           // Use POST or GET depending on your API
						data: {
							permissions: checkedValues,
							role_id : roleId,
						},        // The data to send (form data)
						success: function(response) {
							Swal.fire(
								'Submitted',
								response.message,
								response.data,
							);
						},
						error: function(xhr, status, error) {
							Swal.fire(
								'Error!',
								response.message,
								response.data,
							);
						}
					});
				}else{
					Swal.fire(
						'Cancelled!',
						'Your data is safe.',
						'error'
					);
					
                }
			});
	});
	
	function handleCheckboxState(masterCheckbox, checkboxesClass) {
		const allChecked = $(checkboxesClass + ':checked').length === $(checkboxesClass).length;
		$(masterCheckbox).prop('checked', allChecked);

		$(masterCheckbox).on("change", function() {
			$(checkboxesClass).prop('checked', $(this).prop('checked'));
		});

		$(checkboxesClass).on("change", function() {
			const allChecked = $(checkboxesClass + ':checked').length === $(checkboxesClass).length;
			$(masterCheckbox).prop('checked', allChecked);
		});
	}

	handleCheckboxState('#select_c_all', '.createCheckBoxes');
	handleCheckboxState('#select_r_all', '.readCheckBoxes');
	handleCheckboxState('#select_u_all', '.updateCheckBoxes');
	handleCheckboxState('#select_d_all', '.deleteCheckBoxes');
	handleCheckboxState('#select_f_all', '.fdCheckBoxes');

	
</script>
@endsection