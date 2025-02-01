@extends('layouts.admin-app')

@section('title', $title)


@section('content') 

<div class="container-fluid">
	<div class="row">		
		{!! $breadcrumbHtml !!} 
		<div class="card contentCard">
			<div class="card-body table-responsive">
				<!--begin: Datatable -->
				<table class="table table-striped table-bordered table_data dataex-html5-export dataTable no-footer" id="table_data" role="grid" aria-describedby="table_data_info">
					
					<thead class="">
						<tr>
							<th>SI No.</th>
							<th>Name</th>
							<th style="min-width:200px;">Email</th>
							<th  style="min-width:200px">Mobile No.</th>
							<th style="min-width:120px">Message</th>
							<th style="min-width:80px">Action</th>
						</tr>
					</thead>

				</table>
				<!--end: Datatable -->
			</div>
		</div>
	</div>
</div>
@endsection
@section('customJs')
<script>
    $(document).ready(function(){
       loadAjaxList();
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
                        columns: [0,1,2,3]
                    }
                },
                {
                    extend: 'excelHtml5',
                    footer: true,
                    title: "{{env('APP_NAME')}}",
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    footer: true,
                    title: "{{env('APP_NAME')}}",
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                {
                    extend: 'print',
                    footer: true,
                    title: "{{env('APP_NAME')}}",
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                {
                    extend: 'csv',
                    footer: true,
                    title: "{{env('APP_NAME')}}",
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                'colvis'
            ],
            ajax: "{{route('queries.ajax-list')}}",
            
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'mobile' },
                { data: 'message' },
                { data: 'reply' }
            ], 
            "language":{
                "search":"<i class='fa fa-search'></i>",
                "searchPlaceholder":" Search videos...",
            }
        });
    }
</script>

@endsection






