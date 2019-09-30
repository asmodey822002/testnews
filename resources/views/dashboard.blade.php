<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title', 'News')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', 'Test site News')">
    <meta name="keywords" content="@yield('keywords', 'Laravel, PHP, HTML, CSS, JS, News')">
    <link rel="shortcut icon" type="image/png" href="{{asset('images/yoj.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fontawesome/css/all.css')}}">
</head>
<body class="container-fluid">
	<!-- Header -->
	<div class="row">
		@yield('header')
	</div>
	<!-- end Header -->
	<!-- Content -->
	<div class="row">
		<div class="col-md-4 col-12">
			@yield('sidebar')
		</div>
		<div class="col-md-8 col-12">
			<div class="row">
				@include('parts.successe')
			</div>
			<div class="row">
				<div class="col-12">
					@yield('content')
				</div>
			</div>
		</div>
	</div>
	<!-- end Content -->
	<!--Script-->
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
	
	@yield('script')
	</div>
	<!-- end Script -->
</body>
</html>