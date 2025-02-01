@extends('layouts.admin-app')

@section('title', $title)
@section('content') 
<div class="container-fluid">
	<div class="row">
		{!! $breadcrumbHtml !!}  
		<div class="col-12 bg-white p-5">
		<div class="col-md-6 mx-auto">
			<div class="card">
			<div class="card-header"><b>Add New Module</b></div>
			<div class="card-body">
				<form action="{{route('modules.store')}}" method="post" class="p-3" id="moduleForm">
					@csrf
					<div class="my-3">
 						<input type="checkbox" id="isThereSubModule" class="input"/> 
						<span>Is there any sub-module for this?</span>
					</div>
					<div class="form-group" id="module-div">
						<label>Module Name</label>
						<input class="form-control input" id="module" name="name" value="{{ old('name')? old('name') : @$project->name }}" required>
					</div>
					
					<div class="form-group">
						<label>Module Path</label>
						<input class="form-control input" id="modulePath"  name="url" value="{{ old('path')? old('path') : @$project->path }}" required>
					</div>
					
					<div class="form-group">
						<label>Short Description</label>
						<textarea class="form-control input" name="short_description">
							
						</textarea>
					</div>
					
					<div class="form-group">
						<button type="submit" id="addModuleBtn" class="btn btn-primary">Add Module</button>
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
	$('#isThereSubModule').on('click',function(){
		const html = '<div id="subModuleDiv" class="form-group mt-3"><label>Sub Module</label> <input id="subModule" value="" class="form-control input" name="subModule" required> </div>';
		
		if($('#isThereSubModule').is(':checked')) {
			$("#module-div").append(html); 
		} else {
			$("#subModuleDiv").remove(); 
		}
	})

	$(document).on("change", "#module, #subModule", function() {
		
		const moduleValue = $("#module").val();      // Get the value of the module field
		const subModuleValue = $("#subModule").val(); // Get the value of the submodule field
	
		let url = moduleValue;
		
		url = (typeof subModuleValue !== 'undefined') ? (moduleValue + "/" + subModuleValue) : moduleValue;
		
		$("#modulePath").val(createSlug(url)); // Display the generated URL
		
	});
	
	$("#addModuleBtn").on("click", function(event){
		event.preventDefault(); // Prevent the default form submission
		Swal.fire({
			title: 'Are you sure?',
			text: 'Do you want to submit the form?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, submit it!',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				// Collect the form data
				var formData = $("#moduleForm").serialize(); // Replace '#moduleForm' with your actual form ID

				// Make the AJAX call to submit the form
				$.ajax({
					url: '{{route("modules.store")}}', // Replace with the actual URL to send the request to
					type: 'POST',           // Use POST or GET depending on your API
					data: formData,         // The data to send (form data)
					success: function(response) {
						Swal.fire(
							'Submitted',
							response.message,
							response.data,
						).then(() => {
							$("#moduleForm")[0].reset(); // Reset form fields
						});
					},
					error: function(xhr, status, error) {
						Swal.fire(
							'Error!',
							response.message,
							response.data,
						);
						console.log(error); // Handle any error that occurs during the request
					}
				});
			} else {
				// User canceled the submission
				Swal.fire(
					'Cancelled',
					'Your form was not submitted.',
					'error'
				);
			}
		});
	});


</script>
@endsection