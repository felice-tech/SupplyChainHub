<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Laravel App')</title>
	<link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
	<style>
		.container { max-width: 1100px; margin: 28px auto; padding: 0 12px; }
		.flash { padding:10px; border-radius:4px; margin-bottom:12px; }
		.flash-success { background:#e6ffed; border:1px solid #b6f0c7; }
		.flash-error { background:#ffe6e6; border:1px solid #f0b6b6; }
	</style>
	@yield('head')
</head>
<body>
	<div class="container">
		@if(session('success'))
			<div class="flash flash-success">{{ session('success') }}</div>
		@endif
		@if(session('error'))
			<div class="flash flash-error">{{ session('error') }}</div>
		@endif

		@yield('content')
	</div>

	<script src="{{ asset('assets/js/custom.js') }}"></script>
	@yield('scripts')
</body>
</html>
