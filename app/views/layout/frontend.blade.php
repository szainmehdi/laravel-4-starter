<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="/images/favicon.png">

		<title>@yield('title')</title>

		<!-- Bootstrap core CSS -->
		<link href="/css/frontend.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		@yield('head')
	</head>

	<body>

		@include('frontend.partials.navbar')

		<div class="container" id="main-container">

            @yield('content')

		</div>

		<script src="/js/frontend.min.js"></script>
		@yield('scripts')
	</body>
</html>