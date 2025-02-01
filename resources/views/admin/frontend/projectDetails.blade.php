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
                
			</div>
		</div>
	</div>
</div>
@endsection

@section('customJs')
<script>
</script>
@endsection