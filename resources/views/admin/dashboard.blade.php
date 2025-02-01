@extends('layouts.admin-app')

@section('title', $title)

@section('customCss')
<link rel="stylesheet" href="{{url('assets/customs/css/dashboard.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
		@if(session('error'))
			<div class="alert alert-danger mt-5 mx-auto alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				{{ session('error') }}
			</div>
		@endif
        <div class="col-md-12">
            {!! $breadcrumbHtml !!}
        </div>
    </div>
    <div>
        <div class="row">
		@if(!empty($countData) && count($countData)>0)
			@foreach($countData as $key => $data)
		
            <div class="col-lg-3 col-sm-6 col-12 mb-3">
                <div class="card {{$color[$loop->index]}}">
                    <div class="card-body">
                        <div class="mt-4 d-flex justify-content-between">
                            <div>
                                <h2 class="text1">{{$data}}</h2><br><br> 
                                <p class="text-light text-bold">{{$key}}</p>
                            </div>
							<div class="icon"><i class="{{$icons[$loop->index]}} text-bold"></i></div>
                        </div>
                    </div>
					<a href="#" class="box text-bold">
                    More info <i class="fas fa-arrow-circle-right"></i> 
                </a>
                </div>							
            </div>
			@endforeach
			@endif
            
        </div>
    </div>
	<br>
	
	<div class="card">
		<div class="card-header ui-sortable-handle" style="cursor: move;">
			<h3 class="card-title">
			   <i class="ion ion-clipboard mr-1"></i>
			   Recent Activities
			</h3>
		   
		 </div>
		<div class="card-body table-responsive">
			<!--begin: Datatable -->
			<table class="table table-striped table-bordered table_data dataex-html5-export dataTable no-footer" id="table_data" role="grid" aria-describedby="table_data_info">
				<thead class="">
					<tr>
						<th>SI No.</th>
						<th>Activity</th>
						<th>IP Address</th>
						<th>City</th> 
						<th>User Agent</th>
						<th>Date-Time</th>
					</tr>
				</thead>

			</table>
			<!--end: Datatable -->
		</div>
	</div>
</div>
@endsection

@section('customJs')
<script>
    $(document).ready(function(){
       setTimeout(function(){
		   loadAjaxList();
		},200)
    });
    
	function loadAjaxList(){
	 $("#table_data").DataTable({
		processing: true,
		type:'get',
		serverSide: true,
		destroy: true,
		sortable: true,
		pagination: true,  
		dom: 'lBfrtip', 
		lengthMenu: [
			[ 10, 25, 50, 100, 500, 1000, 1500],
			[ '10 rows', '25 rows', '50 rows', '100 rows', '500 rows', '1000 rows', '1500 rows' ]
		],
		buttons: [
			'pageLength'
		], 
		order: [[0, 'desc']],
		buttons: [
			{
				extend: 'copyHtml5',
				footer: true,
				title: "{{env('APP_NAME')}}",
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'excelHtml5',
				footer: true,
				title: "{{env('APP_NAME')}}",
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'pdfHtml5',
				footer: true,
				title: "{{env('APP_NAME')}}",
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'print',
				footer: true,
				title: "{{env('APP_NAME')}}",
				exportOptions: {
					columns: [0,1,2]
				}
			},
			{
				extend: 'csv',
				footer: true,
				title: "{{env('APP_NAME')}}",
				exportOptions: {
					columns: [0,1,2]
				}
			},
			'colvis'
		],
		ajax: "{{route('dashboard.ajax-list')}}",
		
		columns: [
			{ data: 'id' },
			{ data: 'activity' },
			{ data: 'ip_address' },
			{ data: 'city' },
			{ data: 'user_agent' },
			{ data: 'created_at' }
		], 
		"language":{
			"search":"<i class='fa fa-search'></i>",
			"searchPlaceholder":" Search videos...",
		}
	});
}
	
</script>

@endsection