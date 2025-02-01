@extends('layouts.admin-app')

@section('title', $title)
@section('content') 
<div class="container-fluid">
	<div class="row">
		{!! $breadcrumbHtml !!} 
		<div class="card contentCard">
			<div class="card-body">
			</div>
		</div>
	</div>
</div>
@endsection
@section('customJs')
@endsection