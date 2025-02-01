<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'White Hat Realty')</title>
	<link rel="icon" href="{{url('assets/images/sign-01.png')}}">
    <link rel="stylesheet" href="{{url('assets/libraries/css/bootstrap.min.css')}}">
    @yield('customCss')
    <script src="{{url('assets/libraries/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/libraries/js/jquery.js')}}"></script>
    <script src="{{url('assets/libraries/js/fontsawesome.js')}}"></script>

</head>

<body>
    <!-- Main content -->
    <div class="app">
        @yield('content')
    </div>
    @yield('customJs')
</body>

</html>